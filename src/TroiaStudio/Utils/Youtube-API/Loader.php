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
use TroiaStudio\YoutubeAPI\Factories\ChannelFactory;
use TroiaStudio\YoutubeAPI\Factories\ChannelPlayListFactory;
use TroiaStudio\YoutubeAPI\Factories\VideoFactory;
use TroiaStudio\YoutubeAPI\Model\Channel;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;
use TroiaStudio\YoutubeAPI\Parsers\VideoId;
use TroiaStudio\YoutubeAPI\Requests\ChannelPlayListRequest;
use TroiaStudio\YoutubeAPI\Requests\ChannelRequest;
use TroiaStudio\YoutubeAPI\Requests\PlayListRequest;
use TroiaStudio\YoutubeAPI\Requests\Request;


class Loader
{
	public const LINK = 'https://www.googleapis.com/youtube/v3',
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
	 * @var
	 */
	private $videoRequests = [];

	/**
	 * @var PlayListRequest[]
	 */
	private $playListRequests = [];

	/**
	 * @var ChannelRequest[]
	 */
	private $channelRequests = [];

	/**
	 * @var ChannelPlayListRequest[]
	 */
	private $channelPlayListRequests = [];


	public function __construct(Request $request, int $maxResults = 50)
	{
		$this->request = $request;
		$this->maxResults = $maxResults;
	}


	/**
	 * @return Video
	 * @throws \Nette\Utils\JsonException
	 * @throws \RuntimeException
	 */
	public function video(string $id): Video
	{
		$id = VideoId::parse($id);
		if (!isset($this->videoRequests[$id])) {
			$this->videoRequests[$id] = $this->request->getData(sprintf(self::LINK_VIDEO, $id, '%s'));
		}

		return VideoFactory::create($id, $this->videoRequests[$id]);
	}


	/**
	 * @return PlayList
	 * @throws \Nette\Utils\JsonException
	 * @throws \RuntimeException
	 */
	public function playList(string $id): PlayList
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
	 * @param string $id
	 *
	 * @return Channel
	 * @throws JsonException
	 */
	public function channel(string $id): Channel
	{
		$this->channelRequests[$id] = new ChannelRequest($id, $this->request);
		$request = $this->channelRequests[$id]->load();

		$channel = ChannelFactory::create($id, $request);
		$this->loadChannelPlayLists($channel);

		return $channel;
	}


	/**
	 * @param Channel $channel
	 *
	 * @throws JsonException
	 */
	public function loadChannelPlayLists(Channel $channel): void
	{
		$id = $channel->id;
		$this->channelPlayListRequests[$id] = new ChannelPlayListRequest($id, $this->maxResults, $this->request);
		$request = $this->channelPlayListRequests[$id]->load();

		$ids = ChannelPlayListFactory::get($request);

		foreach ($ids as $index => $playListId) {
			$playList = $this->playList($playListId);
			var_dump($playList);
			$channel->addPlayList($playList);
		}

		$nextPageToken = property_exists($request, 'nextPageToken') ? $request->nextPageToken : null;

		if ($nextPageToken !== null) {
			$this->loadChannelVideoPlayListNextPage($channel, $nextPageToken);
		}
	}


	/**
	 * @param PlayList $playList
	 *
	 * @throws JsonException
	 * @throws \RuntimeException
	 */
	private function loadVideoPlayList(PlayList $playList): void
	{
		foreach ($this->playListRequests[$playList->id]->load()->items as $item) {
			$video = $this->video($item->snippet->resourceId->videoId);
			$playList->addVideo($video);
		}
	}


	/**
	 * @param PlayList $playList
	 * @param string   $nextToken
	 *
	 * @throws JsonException
	 * @throws \RuntimeException
	 */
	private function loadVideoPlayListNextPage(PlayList $playList, string $nextToken): void
	{
		$request = $this->playListRequests[$playList->id]->loadPage($nextToken);
		$nextPageToken = property_exists($request, 'nextPageToken') ? $request->nextPageToken : null;

		foreach ($request->items as $item) {
			$video = $this->video($item->snippet->resourceId->videoId);
			$playList->addVideo($video);
		}

		if ($nextPageToken !== null) {
			$this->loadVideoPlayListNextPage($playList, $nextPageToken);
		}
	}


	/**
	 * @param Channel $channel
	 * @param string  $nextToken
	 *
	 * @throws JsonException
	 */
	private function loadChannelVideoPlayListNextPage(Channel $channel, string $nextToken): void
	{
		$request = $this->channelPlayListRequests[$channel->id]->loadPage($nextToken);
		$nextPageToken = property_exists($request, 'nextPageToken') ? $request->nextPageToken : null;

		$ids = ChannelPlayListFactory::get($request);

		foreach ($ids as $index => $playListId) {
			$channel->addPlayList($this->playList($playListId));
		}

		if ($nextPageToken !== null) {
			$this->loadChannelVideoPlayListNextPage($playList, $nextPageToken);
		}
	}
}
