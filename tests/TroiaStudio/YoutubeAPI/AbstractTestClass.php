<?php
declare(strict_types=1);

namespace TroiaStudioTests\YoutubeAPI;

require_once __DIR__ . '/../bootstrap.php';

use Mockery\MockInterface;
use Tester\TestCase;
use TroiaStudio\YoutubeAPI\Loader;
use TroiaStudio\YoutubeAPI\Requests\ChannelPlayListRequest;
use TroiaStudio\YoutubeAPI\Requests\ChannelRequest;
use TroiaStudio\YoutubeAPI\Requests\PlayListRequest;


abstract class AbstractTestClass extends TestCase
{
	public function setChannelRequest(MockInterface $request, int $maxResults = 7): void
	{
		$channelId = 'UCpZaOc0uEk9gWh-TS7B3A5g';
		$channelRequestURI = sprintf(ChannelRequest::LINK_CHANNEL, $channelId, '%s');
		$channelResponseJSON = file_get_contents(__DIR__ . '/files/response/request/channelRequest.json');
		$channelResponse = json_decode($channelResponseJSON);
		$request->shouldReceive('getData')->withArgs([$channelRequestURI])
			->andReturn($channelResponse);

		$playListsRequestURI = sprintf(ChannelPlayListRequest::LINK_CHANNEL_PLAYLIST, $channelId, $maxResults, '%s');
		$playListsResponseJSON = file_get_contents(__DIR__ . '/files/response/request/playlistsRequest_' . $maxResults . '.json');
		$playListsResponse = json_decode($playListsResponseJSON);
		$request->shouldReceive('getData')->withArgs([$playListsRequestURI])
			->andReturn($playListsResponse);

		$this->setPlayListOverWatch($request, $maxResults);
		$this->setPlayListIntros($request, $maxResults);
	}


	public function setChannelRequestByListOneByOne(MockInterface $request): void
	{
		$maxResults = 1;
		$channelId = 'UCpZaOc0uEk9gWh-TS7B3A5g';
		$channelRequestURI = sprintf(ChannelRequest::LINK_CHANNEL, $channelId, '%s');
		$channelResponseJSON = file_get_contents(__DIR__ . '/files/response/request/channelRequest.json');
		$channelResponse = json_decode($channelResponseJSON);
		$request->shouldReceive('getData')->withArgs([$channelRequestURI])
			->andReturn($channelResponse);

		$playListsRequestURI = sprintf(ChannelPlayListRequest::LINK_CHANNEL_PLAYLIST, $channelId, $maxResults, '%s');
		$playListsResponseJSON = file_get_contents(__DIR__ . '/files/response/request/playlistsRequest_1.json');
		$playListsResponse = json_decode($playListsResponseJSON);
		$request->shouldReceive('getData')->withArgs([$playListsRequestURI])
			->andReturn($playListsResponse);

		$nextPageToken = 'CAEQAA';
		$playListsRequestURI2 = sprintf(ChannelPlayListRequest::LINK_CHANNEL_PLAYLIST_PAGE, $channelId, $maxResults, $nextPageToken, '%s');
		$playListsResponseJSON2 = file_get_contents(__DIR__ . '/files/response/request/playlistsRequest_1_1.json');
		$playListsResponse2 = json_decode($playListsResponseJSON2);
		$request->shouldReceive('getData')->withArgs([$playListsRequestURI2])
			->andReturn($playListsResponse2);

		$this->setPlayListOverWatch($request, $maxResults);
		$this->setPlayListIntros($request, $maxResults);
	}


	public function setPlayListOverWatch(MockInterface $request, int $maxResults = 7): void
	{
		$playList_1 = 'PLbXPig9LCIwbjIr5i2aLz3FL6-LZjpVDo';
		$playListItemsRequestURI_1 = sprintf(PlayListRequest::LINK_PLAYLIST_ITEMS, $playList_1, $maxResults, '%s');
		$playListItemsResponseJSON_1 = file_get_contents(__DIR__ . '/files/response/playlist/PLbXPig9LCIwbjIr5i2aLz3FL6-LZjpVDo.json');
		$playListItemsResponse_1 = json_decode($playListItemsResponseJSON_1);
		$request->shouldReceive('getData')->withArgs([$playListItemsRequestURI_1])
			->andReturn($playListItemsResponse_1);

		$this->setVideo1($request);
		$this->setVideo3($request);
	}


	public function setPlayListIntros(MockInterface $request, int $maxResults = 7): void
	{
		$playList_2 = 'PLbXPig9LCIwb4NFYeXFMdI_NmrTL1EzhH';
		$playListItemsRequestURI_2 = sprintf(PlayListRequest::LINK_PLAYLIST_ITEMS, $playList_2, $maxResults, '%s');
		$playListItemsResponseJSON_2 = file_get_contents(__DIR__ . '/files/response/playlist/PLbXPig9LCIwb4NFYeXFMdI_NmrTL1EzhH.json');
		$playListItemsResponse_2 = json_decode($playListItemsResponseJSON_2);
		$request->shouldReceive('getData')->withArgs([$playListItemsRequestURI_2])
			->andReturn($playListItemsResponse_2);

		$this->setVideo2($request);
	}


	public function setVideo1(MockInterface $request): void
	{
		$video = 'fzcXTWtTLVY';
		$videoRequestURI = sprintf(Loader::LINK_VIDEO, $video, '%s');
		$videoResponseJSON = file_get_contents(__DIR__ . '/files/response/video/' . $video . '.json');
		$videoResponse = json_decode($videoResponseJSON);
		$request->shouldReceive('getData')->withArgs([$videoRequestURI])
			->andReturn($videoResponse);
	}


	public function setVideo2(MockInterface $request): void
	{
		$video = 'gr84kF37gso';
		$videoRequestURI = sprintf(Loader::LINK_VIDEO, $video, '%s');
		$videoResponseJSON = file_get_contents(__DIR__ . '/files/response/video/' . $video . '.json');
		$videoResponse = json_decode($videoResponseJSON);
		$request->shouldReceive('getData')->withArgs([$videoRequestURI])
			->andReturn($videoResponse);
	}


	public function setVideo3(MockInterface $request): void
	{
		$video = 'zqTyJxGPg-Y';
		$videoRequestURI = sprintf(Loader::LINK_VIDEO, $video, '%s');
		$videoResponseJSON = file_get_contents(__DIR__ . '/files/response/video/' . $video . '.json');
		$videoResponse = json_decode($videoResponseJSON);
		$request->shouldReceive('getData')->withArgs([$videoRequestURI])
			->andReturn($videoResponse);
	}
}
