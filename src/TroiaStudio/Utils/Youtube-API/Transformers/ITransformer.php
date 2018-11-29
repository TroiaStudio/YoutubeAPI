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
	public static function fromFileToObject(string $file): ?IModel;

	public static function fromArrayToString(array $data): string;

	public static function save(string $path, string $filename, string $content): void;
}
