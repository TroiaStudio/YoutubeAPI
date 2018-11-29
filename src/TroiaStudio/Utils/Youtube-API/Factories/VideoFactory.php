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
use TroiaStudio\YoutubeAPI\Model\Thumbnail;
use TroiaStudio\YoutubeAPI\Model\Video;


class VideoFactory
{

	/**
	 * @param string    $id
	 * @param \stdClass $request
	 *
	 * @return Video
	 * @throws \Exception
	 */
	public static function create(string $id, \stdClass $request): Video
	{
		if (!isset($request->items[0])) {
			$items = $request;
		} else {
			$items = $request->items[ 0 ];
		}

		if (!isset($items->snippet)) {
			throw new \RuntimeException("Empty YouTube response, probably wrong '{$id}' video id.");
		}

		$snippet = $items->snippet;
		$video = new Video();

		if (!isset($items->contentDetails)) {
			$duration = 0;
		} else {
			$details = $items->contentDetails;
			$duration = $details->duration;
		}

		if (!isset($items->statistics)) {
			$views = 0;
		} else {
			$statistics = $items->statistics;
			$views = (int) $statistics->viewCount;
		}

		$video->id = $id;
		$video->title = $snippet->title;
		$video->description = $snippet->description;

		$video->url = 'https://www.youtube.com/watch?v=' . $id;
		$video->embed = 'https://www.youtube.com/embed/' . $id;

		$video->views = $views;
		$video->duration = $duration;
		$video->published = new DateTime($snippet->publishedAt);
		$video->tags = property_exists($snippet, 'tags') ? $snippet->tags : [];

		/** @var Thumbnail $thumbnail */
		foreach (ThumbnailFactory::get($snippet) as $res => $thumbnail) {
			$video->addThumbnail($res, $thumbnail);
		}

		return $video;
	}

	public static function fromFile(\stdClass $class): Video
	{
		$video = new Video();

		$video->id = $class->id;
		$video->title = $class->title;
		$video->description = $class->description;

		$video->url = $class->url;
		$video->embed = $class->embed;

		$video->views = $class->views;
		$video->duration = $class->duration;
		$video->published = new DateTime($class->published);
		$video->tags = property_exists($class, 'tags') ? $class->tags : [];

		/** @var Thumbnail $thumbnail */
		foreach (ThumbnailFactory::get($snippet) as $res => $thumbnail) {
			$video->addThumbnail($res, $thumbnail);
		}

		return $video;
	}
}
