<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube\Channel;


/**
 * https://developers.google.com/youtube/v3/docs/channel
 */
class Status
{

	/**
	 * @var string
	 */
	public $privacyStatus;

	/**
	 * @var bool
	 */
	public $isLinked;

	/**
	 * @var string
	 */
	public $longUploadsStatus;
}
