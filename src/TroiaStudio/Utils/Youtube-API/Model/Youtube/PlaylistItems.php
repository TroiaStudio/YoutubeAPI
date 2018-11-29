<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube;


/**
 * https://developers.google.com/youtube/v3/docs/playlistitems
 */
class PlaylistItems
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
	 * @var string
	 */
	public $nextPageToken;

	/**
	 * @var PageInfo
	 */
	public $pageInfo;

	/**
	 * @var PlaylistItem\PlaylistItem[]
	 */
	public $items;
}
