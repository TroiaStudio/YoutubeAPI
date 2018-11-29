<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 13.7.18
 * Time: 16:15
 */

namespace TroiaStudio\YoutubeAPI\Transformers;


use TroiaStudio\YoutubeAPI\Model\Channel;
use TroiaStudio\YoutubeAPI\Model\IModel;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;


class JsonTransformer implements ITransformer
{

	public static function save(string $path, string $filename, string $content): void
	{
		file_put_contents($path . '/' . $filename, $content);
	}

	public function fromFileToObject(string $file): IModel
	{

	}

	public function fromObjectToString(IModel $model): string
	{
		return (string) json_encode($model->toArray());
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
