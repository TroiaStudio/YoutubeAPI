<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Validators;


use TroiaStudio\YoutubeAPI\Model\Channel;
use TroiaStudio\YoutubeAPI\Model\IModel;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;


class Type
{
	public static function detect(\stdClass $class): IModel
	{
		$mapper = new \JsonMapper();
		$mapper->classMap['channel'] = Channel::class;
		$mapper->classMap['playlist'] = PlayList::class;

		if (property_exists($class, 'channel')) {
			/** @var IModel $model */
			$model = $mapper->map($class->channel, new Channel());
		} elseif (property_exists($class, 'playlist')) {
			/** @var IModel $model */
			$model = $mapper->map($class->playlist, new PlayList());
		} else {
			/** @var IModel $model */
			$model = $mapper->map($class, new Video());
		}

		return $model;
	}
}
