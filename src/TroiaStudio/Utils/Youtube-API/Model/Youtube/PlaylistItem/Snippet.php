<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube\PlaylistItem;


use TroiaStudio\YoutubeAPI\Model\Youtube\Thumbnailable;


/**
 * https://developers.google.com/youtube/v3/docs/playlists
 */
class Snippet implements Thumbnailable
{

	/**
	 * @var string
	 */
	public $publishedAt;

	/**
	 * @var string
	 */
	public $channelId;

	/**
	 * @var string
	 */
	public $title;

	/**
	 * @var string
	 */
	public $description;

	/**
	 * @var \TroiaStudio\YoutubeAPI\Model\Youtube\Thumbnail[]
	 */
	public $thumbnails;

	/**
	 * @var string
	 */
	public $channelTitle;

	/**
	 * @var string
	 */
	public $playlistId;

	/**
	 * @var int
	 */
	public $position;

	/**
	 * @var ResourceId[]
	 */
	public $resourceId;


	/**
	 * @return \TroiaStudio\YoutubeAPI\Model\Youtube\Thumbnail[]
	 */
	public function getThumbnails(): array
	{
		return $this->thumbnails;
	}
}
