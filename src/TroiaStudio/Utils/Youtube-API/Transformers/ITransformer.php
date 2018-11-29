<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 13.7.18
 * Time: 16:09
 */

namespace TroiaStudio\YoutubeAPI\Transformers;


use TroiaStudio\YoutubeAPI\Model\IModel;


interface ITransformer
{
	public function fromFileToObject(string $file): IModel;

	public function fromObjectToString(IModel $model): string;

	public static function save(string $path, string $filename, string $content): void;

	public function isChannel(): bool;

	public function isPlayList(): bool;

	public function isVideo(): bool;
}
