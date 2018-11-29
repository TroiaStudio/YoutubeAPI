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
use TroiaStudio\YoutubeAPI\Model\Youtube\Channels;
use TroiaStudio\YoutubeAPI\Model\Youtube\PlaylistItems;
use TroiaStudio\YoutubeAPI\Model\Youtube\Playlists;
use TroiaStudio\YoutubeAPI\Model\Youtube\Videos;
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
	 * @var Videos[]
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
	 * @throws \JsonMapper_Exception
	 */
	public function video(string $id): Video
	{
		$id = VideoId::parse($id);
		if (!isset($this->videoRequests[$id])) {
			$response = $this->request->getData(sprintf(self::LINK_VIDEO, $id, '%s'));
			$mapper = new \JsonMapper();
			/** @var Videos $videos */
			$videos = $mapper->map($response, new Videos());
			$this->videoRequests[$id] = $videos;
		}


		return VideoFactory::create($id, $this->videoRequests[$id]);
	}


	/**
	 * @return PlayList
	 * @throws \Nette\Utils\JsonException
	 * @throws \RuntimeException
	 * @throws \JsonMapper_Exception
	 */
	public function playList(string $id): PlayList
	{
		$this->playListRequests[$id] = new PlayListRequest($id, $this->maxResults, $this->request);
		$response = $this->playListRequests[$id]->load();

		$mapper = new \JsonMapper();
		/** @var Playlists $youtubePlaylist */
		$youtubePlaylist = $mapper->map($response, new Playlists());

		$playList = PlayList::create($id, $youtubePlaylist);
		$nextPageToken = property_exists($response, 'nextPageToken') ? $response->nextPageToken : null;
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
	 * @throws \JsonMapper_Exception
	 */
	public function channel(string $id): Channel
	{
		$this->channelRequests[$id] = new ChannelRequest($id, $this->request);
		$response = $this->channelRequests[$id]->load();


		$mapper = new \JsonMapper();
		/** @var Channels $youtubeChannel */
		$youtubeChannel = $mapper->map($response, new Channels());

		$channel = ChannelFactory::create($id, $youtubeChannel);
		$this->loadChannelPlayLists($channel);

		return $channel;
	}


	/**
	 * @param Channel $channel
	 *
	 * @throws JsonException
	 * @throws \JsonMapper_Exception
	 */
	public function loadChannelPlayLists(Channel $channel): void
	{
		$id = $channel->id;
		$this->channelPlayListRequests[$id] = new ChannelPlayListRequest($id, $this->maxResults, $this->request);
		$response = $this->channelPlayListRequests[$id]->load();

		$mapper = new \JsonMapper();
		/** @var PlaylistItems $youtubeChannelPlaylist */
		$youtubeChannelPlaylist = $mapper->map($response, new PlaylistItems());
		$ids = ChannelPlayListFactory::get($youtubeChannelPlaylist);

		foreach ($ids as $index => $playListId) {
			$playList = $this->playList($playListId);
			$channel->addPlayList($playList);
		}

		if ($youtubeChannelPlaylist->nextPageToken !== null) {
			$this->loadChannelVideoPlayListNextPage($channel, $youtubeChannelPlaylist->nextPageToken);
		}
	}


	/**
	 * @param PlayList $playList
	 *
	 * @throws JsonException
	 * @throws \RuntimeException
	 * @throws \JsonMapper_Exception
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
	 * @throws \JsonMapper_Exception
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
	 * @throws \JsonMapper_Exception
	 */
	private function loadChannelVideoPlayListNextPage(Channel $channel, string $nextToken): void
	{
		$response = $this->channelPlayListRequests[$channel->id]->loadPage($nextToken);

		$mapper = new \JsonMapper();
		/** @var PlaylistItems $youtubeChannelPlaylist */
		$youtubeChannelPlaylist = $mapper->map($response, new PlaylistItems());
		$ids = ChannelPlayListFactory::get($youtubeChannelPlaylist);

		foreach ($ids as $index => $playListId) {
			$channel->addPlayList($this->playList($playListId));
		}

		if ($youtubeChannelPlaylist->nextPageToken !== null) {
			$this->loadChannelVideoPlayListNextPage($channel, $youtubeChannelPlaylist->nextPageToken);
		}
	}
}
