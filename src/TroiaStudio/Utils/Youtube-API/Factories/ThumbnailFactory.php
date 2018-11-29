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


class ThumbnailFactory
{

	/**
	 * @param \stdClass $snippet
	 *
	 * @return Thumbnail[]
	 * @throws \Exception
	 */
	public static function get(\stdClass $snippet): array
	{
		$items = [];
		foreach (['default', 'medium', 'high', 'standard', 'maxres'] as $thumb) {
			if (isset($snippet->thumbnails->$thumb)) {
				$th = $snippet->thumbnails->$thumb;
				$items[$thumb] = new Thumbnail($th->url, $th->width, $th->height);
			}
		}

		return $items;
	}
}
