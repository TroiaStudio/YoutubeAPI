<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 10.7.18
 * Time: 14:31
 */

namespace TroiaStudio\YoutubeAPI\Factories;

use Nette\Utils\DateTime;
use TroiaStudio\YoutubeAPI\Model\Channel;


class ChannelFactory
{

	/**
	 * @param string $id
	 * @param \stdClass $request
	 *
	 * @return Channel
	 * @throws \Exception
	 */
	public static function create(string $id, \stdClass $request): Channel
	{
		$items = $request->items[0];

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

		$channel->published = new DateTime($snippet->publishedAt);
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

	public static function fromFile(\stdClass $class): Channel
	{
		$channel = new Channel();

		$channel->id = $class->id;
		$channel->kind = $class->kind;
		$channel->etag = $class->etag;
		$channel->totalResults = $class->totalResults;
		$channel->resultsPerPage = $class->resultsPerPage;

		$channel->published = new DateTime($class->publishedAt);
		$channel->title = $class->title;
		$channel->description = $class->description;
		$channel->url = $class->url;
		$channel->customUrl = $class->customUrl;
		$channel->views = $class->viewCount;
		$channel->commentCount = $class->commentCount;
		$channel->subscriberCount = $class->subscriberCount;
		$channel->hiddenSubscriberCount = $class->hiddenSubscriberCount;
		$channel->videoCount = $class->videoCount;

		foreach (ThumbnailFactory::get($snippet) as $res => $thumbnail) {
			$channel->addThumbnail($res, $thumbnail);
		}

		return $channel;
	}
}
