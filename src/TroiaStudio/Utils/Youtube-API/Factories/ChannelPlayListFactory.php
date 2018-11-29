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


class ChannelPlayListFactory
{

	/**
	 * @param \stdClass $request
	 *
	 * @return array
	 */
	public static function get(\stdClass $request): array
	{
		$result = [];

		foreach ($request->items as $index => $item) {
			//$snippet = $item->snippet;
			$result[$index] = $item->id;
		}

		return $result;
	}
}
