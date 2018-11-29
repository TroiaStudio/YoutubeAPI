<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 10.7.18
 * Time: 14:31
 */

namespace TroiaStudio\YoutubeAPI\Factories;

use TroiaStudio\YoutubeAPI\Model\Thumbnail;
use TroiaStudio\YoutubeAPI\Model\Video;
use TroiaStudio\YoutubeAPI\Model\Youtube\Videos;


class VideoFactory
{

	/**
	 * @param string    $id
	 * @param Videos $request
	 *
	 * @return Video
	 * @throws \Exception
	 */
	public static function create(string $id, Videos $request): Video
	{
		$items = $request->items[0];

		if ($items->snippet === null) {
			throw new \RuntimeException("Empty YouTube response, probably wrong '{$id}' video id.");
		}

		$snippet = $items->snippet;
		$video = new Video();

		if ($items->contentDetails === null) {
			$duration = '';
		} else {
			$details = $items->contentDetails;
			$duration = $details->duration;
		}

		if ($items->statistics === null) {
			$views = 0;
		} else {
			$statistics = $items->statistics;
			$views = $statistics->viewCount;
		}

		$video->id = $id;
		$video->title = $snippet->title;
		$video->description = $snippet->description;

		$video->url = 'https://www.youtube.com/watch?v=' . $id;
		$video->embed = 'https://www.youtube.com/embed/' . $id;

		$video->views = $views;
		$video->duration = $duration;
		$video->setPublished($snippet->publishedAt);
		$video->tags = property_exists($snippet, 'tags') ? $snippet->tags : [];

		/** @var Thumbnail $thumbnail */
		foreach (ThumbnailFactory::get($snippet) as $res => $thumbnail) {
			$video->addThumbnail($res, $thumbnail);
		}

		return $video;
	}
}
