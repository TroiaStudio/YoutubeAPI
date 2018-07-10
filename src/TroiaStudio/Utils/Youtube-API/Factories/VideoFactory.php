<?php
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
	public static function create(string $id, \stdClass $request)
	{
		$items = $request->items[0];

		if (!isset($items->snippet, $items->contentDetails, $items->status, $items->statistics)) {
			throw new \RuntimeException("Empty YouTube response, probably wrong '{$id}' video id.");
		}

		$snippet = $items->snippet;
		$details = $items->contentDetails;
		$statistics = $items->statistics;

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
		foreach (['default','medium','high','standard','maxres'] as $thumb) {
			if (isset($snippet->thumbnails->$thumb)) {
				$th = $snippet->thumbnails->$thumb;
				$video->thumbs[$thumb] = new Thumbnail($th->url, $th->width, $th->height);
			}
		}
		return $video;
	}
}