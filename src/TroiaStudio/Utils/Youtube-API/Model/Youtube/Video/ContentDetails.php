<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube\Video;


/**
 * https://developers.google.com/youtube/v3/docs/videos
 */
class ContentDetails
{

	/**
	 * @var string
	 */
	public $duration;

	/**
	 * @var string
	 */
	public $dimension;

	/**
	 * @var string
	 */
	public $definition;

	/**
	 * @var string
	 */
	public $caption;

	/**
	 * @var bool
	 */
	public $licensedContent;

	/**
	 * @var string
	 */
	public $projection;

	/**
	 * @var bool
	 */
	public $hasCustomThumbnail;
}
