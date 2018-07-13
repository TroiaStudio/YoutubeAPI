<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 13.7.18
 * Time: 16:11
 */

namespace TroiaStudio\YoutubeAPI\Export;


use Symfony\Component\Yaml\Yaml;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;


class YamlExport implements IExport
{
	public function video(Video $video): string
	{
		return Yaml::dump($video->toArray(), 10);
	}


	public function playList(PlayList $playList): string
	{
		return Yaml::dump($playList->toArray(), 10);
	}


	public static function save(string $path, string $filename, string $content): void
	{
		file_put_contents($path . '/' . $filename, $content);
	}
}
