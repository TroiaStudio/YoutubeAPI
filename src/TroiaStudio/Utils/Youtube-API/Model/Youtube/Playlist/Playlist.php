<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube\Playlist;


/**
 * https://developers.google.com/youtube/v3/docs/playlists
 */
class Playlist
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
	public $id;

	/**
	 * @var Snippet
	 */
	public $snippet;

	/**
	 * @var Status
	 */
	public $status;

	/**
	 * @var ContentDetails
	 */
	public $contentDetails;
}
