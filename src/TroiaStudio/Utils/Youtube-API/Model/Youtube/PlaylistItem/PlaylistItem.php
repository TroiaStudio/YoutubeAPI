<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube\PlaylistItem;


class PlaylistItem
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
	 * @var ContentDetails
	 */
	public $contentDetails;

	/**
	 * @var Status
	 */
	public $status;
}
