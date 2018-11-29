<?php


namespace TroiaStudio\YoutubeAPI\Transformers;


use TroiaStudio\YoutubeAPI\Model\Channel;
use TroiaStudio\YoutubeAPI\Model\IModel;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;


class ValidType
{
	public function check(\stdClass $class): IModel
	{
		if (property_exists($class, 'channel')) {
			return new Channel();
		}

		if (property_exists($class, 'playlist')) {
			return new PlayList();
		}

		return new Video();
	}
}