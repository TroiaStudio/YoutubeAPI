<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube\Channel;


/**
 * https://developers.google.com/youtube/v3/docs/channels
 */
class Statistics
{

	/**
	 * @var int
	 */
	public $viewCount;

	/**
	 * @var int
	 */
	public $commentCount;

	/**
	 * @var int
	 */
	public $subscriberCount;

	/**
	 * @var bool
	 */
	public $hiddenSubscriberCount;

	/**
	 * @var int
	 */
	public $videoCount;
}
