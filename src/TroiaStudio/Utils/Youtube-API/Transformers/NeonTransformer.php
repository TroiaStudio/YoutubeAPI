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
use TroiaStudio\YoutubeAPI\Model\IModel;
use TroiaStudio\YoutubeAPI\Validators\Type;


class NeonTransformer extends AbstractTransformer
{
	public static function fromFileToObject(string $file): ?IModel
	{
		$fileString = file_get_contents($file);

		if ($fileString === false) {
			return null;
		}
		$objectJson = json_decode($fileString);

		if ($objectJson === false) {
			return null;
		}
		/** @var IModel $object */
		$object = Type::detect($objectJson);
		return $object;
	}


	public static function fromArrayToString(array $data): string
	{
		return Neon::encode($data, Neon::BLOCK);
	}
}
