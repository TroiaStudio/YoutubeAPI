<?php
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 10.7.18
 * Time: 14:13
 */

namespace TroiaStudio\YoutubeAPI\Parsers;


class VideoId implements IParser
{
	public static function parse(string $value): string
	{
		$pattern = '#^(?:https?://|//)?(?:www\.|m\.)?(?:youtu\.be/|youtube\.com/(?:embed/|v/|watch\?v=|watch\?.+&v=))([\w-]{11})(?![\w-])#';
		preg_match($pattern, $value, $matches);

		if (isset($matches[1])) {
			return $matches[1];
		}

		return $value;
	}
}