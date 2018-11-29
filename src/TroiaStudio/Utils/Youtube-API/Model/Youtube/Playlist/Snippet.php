<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube\Playlist;


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
	 * @var \TroiaStudio\YoutubeAPI\Model\Youtube\Localized
	 */
	public $localized;


	/**
	 * @return \TroiaStudio\YoutubeAPI\Model\Youtube\Thumbnail[]
	 */
	public function getThumbnails(): array
	{
		return $this->thumbnails;
	}
}
