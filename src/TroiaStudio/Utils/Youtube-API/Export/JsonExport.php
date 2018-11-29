<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 13.7.18
 * Time: 16:15
 */

namespace TroiaStudio\YoutubeAPI\Export;


use TroiaStudio\YoutubeAPI\Model\Channel;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;


class JsonExport implements IExport
{
	public function video(Video $video): string
	{
		return (string) json_encode($video->toArray());
	}


	public function playList(PlayList $playList): string
	{
		return (string) json_encode(['playlist' => $playList->toArray()]);
	}


	public function channel(Channel $channel): string
	{
		return (string) json_encode(['channel' => $channel->toArray()]);
	}


	public static function save(string $path, string $filename, string $content): void
	{
		file_put_contents($path . '/' . $filename, $content);
	}
}
