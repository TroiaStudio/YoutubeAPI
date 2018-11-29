<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 13.7.18
 * Time: 16:11
 */

namespace TroiaStudio\YoutubeAPI\Export;

use Nette\Neon\Neon;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;


class NeonExport implements IExport
{
	public function video(Video $video): string
	{
		return Neon::encode($video->toArray(), Neon::BLOCK);
	}


	public function playList(PlayList $playList): string
	{
		return Neon::encode($playList->toArray(), Neon::BLOCK);
	}


	public static function save(string $path, string $filename, string $content): void
	{
		file_put_contents($path . '/' . $filename, $content);
	}
}
