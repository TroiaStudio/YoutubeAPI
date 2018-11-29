<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube\Video;


/**
 * https://developers.google.com/youtube/v3/docs/videos
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
	public $likeCount;

	/**
	 * @var int
	 */
	public $dislikeCount;

	/**
	 * @var int
	 */
	public $favouriteCount;

	/**
	 * @var int
	 */
	public $commentCount;
}
