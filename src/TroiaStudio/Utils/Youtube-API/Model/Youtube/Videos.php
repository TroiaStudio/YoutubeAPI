<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube;


/**
 * https://developers.google.com/youtube/v3/docs/videos
 */
class Videos
{

	/**
	 * @var string
	 */
	public $kind;

	/**
	 * @var string
	 */
	public $etag;

	/**
	 * @var PageInfo
	 */
	public $pageInfo;

	/**
	 * @var Video\Video[]
	 */
	public $items;
}
