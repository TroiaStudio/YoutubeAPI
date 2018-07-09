<?php
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 9.7.18
 * Time: 13:17
 */

namespace TroiaStudio\YoutubeAPI;


use Nette\Utils\DateTime;
use TroiaStudio\YoutubeAPI\Model\PlayList;


class Loader
{

	const LINK = 'https://www.googleapis.com/youtube/v3',
		  LINK_VIDEO = self::LINK . '/videos?id=%s&part=snippet,contentDetails,statistics,status&key=%s',
		  LINK_PLAYLIST_ITEMS = self::LINK . '/playlistItems?playlistId=%s&maxResults=%d&part=status&key=%s',
		  LINK_PLAYLIST_ITEMS_PAGE = self::LINK . '/playlistItems?playlistId=%s&maxResults=%d&part=status&pageToken=%s&key=%s';

	/**
	 * @var Request
	 */
	private $request;

	/**
	 * @var int
	 */
	private $maxResults;

	/**
	 * @var \TroiaStudio\YoutubeAPI\PlayList\Request[]
	 */
	private $playListRequests = [];


	public function __construct(Request $request, int $maxResults = 50)
	{
		$this->request = $request;
		$this->maxResults = $maxResults;
	}


	public function video($id)
	{
		$request = $this->request->getData(sprintf(self::LINK_VIDEO, $id, '%s'));
		$snippet = $request->items[0]->snippet;
		$details = $request->items[0]->contentDetails;
		$statistics = $request->items[0]->statistics;
		$thumbFormats = [
			'default',
			'medium',
			'high',
			'standard',
			'maxres'
		];

		$video = new Video();
		$video->id = $id;
		$video->title = $snippet->title;
		$video->description = $snippet->description;
		$video->url = 'https://www.youtube.com/watch?v=' . $id;
		$video->embed = 'https://www.youtube.com/embed/' . $id;
		$video->views = (int) $statistics->viewCount;
		$video->duration = $details->duration;
		$video->published = new DateTime($snippet->publishedAt);
		$video->tags = property_exists($snippet, 'tags') ? $snippet->tags : [];

		foreach ($thumbFormats as $thumb) {
			if (isset($snippet->thumbnails->$thumb)) {
				$video->thumbs[$thumb] = $snippet->thumbnails->$thumb;
			}
		}
		return $video;
	}


	public function playList($id): PlayList
	{
		$this->playListRequests[$id] = new \TroiaStudio\YoutubeAPI\PlayList\Request($id, $this->maxResults, $this->request);
		$request = $this->playListRequests[$id]->load();

		$playList = new PlayList($id, $request);
		$nextPageToken = property_exists($request, 'nextPageToken') ? $request->nextPageToken : null;
		$this->loadVideoPlayList($playList);

		if ($nextPageToken !== null) {
			$this->loadVideoPlayListNextPage($playList, $nextPageToken);
		}
		return $playList;
	}


	private function loadVideoPlayList(PlayList $playList)
	{
		foreach ($this->playListRequests[$playList->id]->load()->items as $item) {
			$playList->addVideo($this->video($item->snippet->resourceId->videoId));
		}
	}


	private function loadVideoPlayListNextPage(PlayList $playList, string $nextToken)
	{
		$request = $this->playListRequests[$playList->id]->loadPage($nextToken);
		$nextPageToken = property_exists($request, 'nextPageToken') ? $request->nextPageToken : null;

		foreach ($request->items as $item) {
			$playList->addVideo($this->video($item->snippet->resourceId->videoId));
		}

		if ($nextPageToken !== null) {
			$this->loadVideoPlayListNextPage($playList, $nextPageToken);
		}
	}
}