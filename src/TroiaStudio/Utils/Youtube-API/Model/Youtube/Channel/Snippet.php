<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube\Channel;


use TroiaStudio\YoutubeAPI\Model\Youtube\Thumbnailable;


/**
 * https://developers.google.com/youtube/v3/docs/channel
 */
class Snippet implements Thumbnailable
{

	/**
	 * @var string
	 */
	public $title;

	/**
	 * @var string
	 */
	public $description;

	/**
	 * @var string
	 */
	public $customUrl;

	/**
	 * @var string
	 */
	public $publishedAt;

	/**
	 * @var \TroiaStudio\YoutubeAPI\Model\Youtube\Thumbnail[]
	 */
	public $thumbnails;

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
