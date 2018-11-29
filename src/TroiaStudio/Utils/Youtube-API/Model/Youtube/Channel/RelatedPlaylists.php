<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube\Channel;


/**
 * https://developers.google.com/youtube/v3/docs/channel
 */
class RelatedPlaylists
{

	/**
	 * @var string
	 */
	public $uploads;

	/**
	 * @var string
	 */
	public $watchHistory;

	/**
	 * @var string
	 */
	public $watchLater;
}
