<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Transformers;


use TroiaStudio\YoutubeAPI\Model\Channel;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;


abstract class AbstractTransformer implements ITransformer
{
	public static function save(string $path, string $filename, string $content): void
	{
		file_put_contents($path . '/' . $filename, $content);
	}


	public static function channel(Channel $channel): string
	{
		return static::fromArrayToString(['channel' => $channel->toArray()]);
	}


	public static function playlist(PlayList $playList): string
	{
		return static::fromArrayToString(['playlist' => $playList->toArray()]);
	}


	public static function video(Video $video): string
	{
		return self::fromArrayToString(['video' => $video->toArray()]);
	}
}
