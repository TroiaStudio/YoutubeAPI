<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 9.7.18
 * Time: 13:17
 */

namespace TroiaStudio\YoutubeAPI;

use Nette\Utils\JsonException;
use TroiaStudio\YoutubeAPI\Factories\VideoFactory;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;
use TroiaStudio\YoutubeAPI\Parsers\VideoId;
use TroiaStudio\YoutubeAPI\Requests\PlayListRequest;
use TroiaStudio\YoutubeAPI\Requests\Request;


class Loader
{
	const LINK = 'https://www.googleapis.com/youtube/v3',
		  LINK_VIDEO = self::LINK . '/videos?id=%s&part=snippet,contentDetails,statistics,status&key=%s';

	/**
	 * @var Request
	 */
	private $request;

	/**
	 * @var int
	 */
	private $maxResults;

	/**
	 * @var PlayListRequest[]
	 */
	private $playListRequests = [];


	public function __construct(Request $request, int $maxResults = 50)
	{
		$this->request = $request;
		$this->maxResults = $maxResults;
	}


	/**
	 * @param $id
	 *
	 * @return Video
	 * @throws \Nette\Utils\JsonException
	 * @throws \RuntimeException
	 */
	public function video($id): Video
	{
		$id = VideoId::parse($id);
		$request = $this->request->getData(sprintf(self::LINK_VIDEO, $id, '%s'));
		return VideoFactory::create($id, $request);
	}


	/**
	 * @param $id
	 *
	 * @return PlayList
	 * @throws \Nette\Utils\JsonException
	 * @throws \RuntimeException
	 */
	public function playList($id): PlayList
	{
		$this->playListRequests[$id] = new PlayListRequest($id, $this->maxResults, $this->request);
		$request = $this->playListRequests[$id]->load();

		$playList = new PlayList($id, $request);
		$nextPageToken = property_exists($request, 'nextPageToken') ? $request->nextPageToken : null;
		$this->loadVideoPlayList($playList);

		if ($nextPageToken !== null) {
			$this->loadVideoPlayListNextPage($playList, $nextPageToken);
		}

		return $playList;
	}


	/**
	 * @param PlayList $playList
	 *
	 * @throws JsonException
	 * @throws \RuntimeException
	 */
	private function loadVideoPlayList(PlayList $playList)
	{
		foreach ($this->playListRequests[$playList->id]->load()->items as $item) {
			$playList->addVideo($this->video($item->snippet->resourceId->videoId));
		}
	}


	/**
	 * @param PlayList $playList
	 * @param string   $nextToken
	 *
	 * @throws JsonException
	 * @throws \RuntimeException
	 */
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
