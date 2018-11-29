<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 13.7.18
 * Time: 16:11
 */

namespace TroiaStudio\YoutubeAPI\Transformers;

use Nette\Neon\Neon;
use TroiaStudio\YoutubeAPI\Model\Channel;
use TroiaStudio\YoutubeAPI\Model\IModel;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;


class NeonTransformer implements ITransformer
{
	public function video(Video $video): string
	{
		return Neon::encode($video->toArray(), Neon::BLOCK);
	}


	public function playList(PlayList $playList): string
	{
		return Neon::encode($playList->toArray(), Neon::BLOCK);
	}


	public function channel(Channel $channel): string
	{
		return Neon::encode($channel->toArray(), Neon::BLOCK);
	}


	public static function save(string $path, string $filename, string $content): void
	{
		file_put_contents($path . '/' . $filename, $content);
	}

	public function fromFileToObject(string $file): IModel
	{
		// TODO: Implement fromFileToObject() method.
	}

	public function fromObjectToString(IModel $model): string
	{
		// TODO: Implement fromObjectToString() method.
	}

	public function isChannel(): bool
	{
		// TODO: Implement isChannel() method.
	}

	public function isPlayList(): bool
	{
		// TODO: Implement isPlayList() method.
	}

	public function isVideo(): bool
	{
		// TODO: Implement isVideo() method.
	}
}
