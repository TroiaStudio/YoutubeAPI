<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube\Channel;


/**
 * https://developers.google.com/youtube/v3/docs/channel
 */
class Channel
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

	/**
	 * @var Statistics
	 */
	public $statistics;
}
