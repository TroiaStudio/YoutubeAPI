<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube\Video;


/**
 * https://developers.google.com/youtube/v3/docs/videos
 */
class Status
{

	/**
	 * @var string
	 */
	public $uploadStatus;

	/**
	 * @var string
	 */
	public $privacyStatus;

	/**
	 * @var string
	 */
	public $license;

	/**
	 * @var bool
	 */
	public $embeddable;

	/**
	 * @var bool
	 */
	public $publicStatsViewable;
}
