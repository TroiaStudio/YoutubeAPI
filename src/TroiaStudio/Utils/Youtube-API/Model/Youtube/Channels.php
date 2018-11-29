<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube;


/**
 * https://developers.google.com/youtube/v3/docs/channels
 */
class Channels
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
	 * @var Channel\Channel[]
	 */
	public $items;
}
