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
use TroiaStudio\YoutubeAPI\Model\Youtube;

class ThumbnailFactory
{

	/**
	 * @param Youtube\Thumbnailable $snippet
	 *
	 * @return Thumbnail[]
	 */
	public static function get(Youtube\Thumbnailable $snippet): array
	{
		$items = [];
		$thumbnails = $snippet->getThumbnails();
		foreach (['default', 'medium', 'high', 'standard', 'maxres'] as $thumb) {
			if (isset($thumbnails[$thumb])) {
				$th = $thumbnails[$thumb];
				$items[$thumb] = new Thumbnail($th->url, $th->width, $th->height);
			}
		}

		return $items;
	}
}
