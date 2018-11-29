<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 10.7.18
 * Time: 14:31
 */

namespace TroiaStudio\YoutubeAPI\Factories;

use TroiaStudio\YoutubeAPI\Model\Channel;
use TroiaStudio\YoutubeAPI\Model\Youtube\Channels;


class ChannelFactory
{

	/**
	 * @param string $id
	 * @param Channels $request
	 *
	 * @return Channel
	 * @throws \Exception
	 */
	public static function create(string $id, Channels $request): Channel
	{
		if (!isset($request->items[0])) {
			$items = $request;
		} else {
			$items = $request->items[0];
		}

		if (!isset($items->snippet, $items->contentDetails, $items->status, $items->statistics)) {
			throw new \RuntimeException("Empty YouTube response, probably wrong '{$id}' channel id.");
		}

		$snippet = $items->snippet;

		$statistics = $items->statistics;

		$channel = new Channel();
		$channel->id = $id;
		$channel->kind = $items->kind;
		$channel->etag = $items->etag;
		$channel->totalResults = $request->pageInfo->totalResults;
		$channel->resultsPerPage = $request->pageInfo->resultsPerPage;

		$channel->setPublished($snippet->publishedAt);
		$channel->title = $snippet->title;
		$channel->description = $snippet->description;
		$channel->url = 'https://www.youtube.com/channel/' . $id;
		$channel->customUrl = 'https://www.youtube.com/user/' . $snippet->customUrl;
		$channel->views = (int) $statistics->viewCount;
		$channel->commentCount = (int) $statistics->commentCount;
		$channel->subscriberCount = (int) $statistics->subscriberCount;
		$channel->hiddenSubscriberCount = (bool) $statistics->hiddenSubscriberCount;
		$channel->videoCount = (int) $statistics->videoCount;

		foreach (ThumbnailFactory::get($snippet) as $res => $thumbnail) {
			$channel->addThumbnail($res, $thumbnail);
		}

		return $channel;
	}
}
