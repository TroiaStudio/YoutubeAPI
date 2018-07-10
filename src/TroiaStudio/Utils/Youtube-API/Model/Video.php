<?php
namespace TroiaStudio\YoutubeAPI\Model;

use Nette;
use TroiaStudio\YoutubeAPI\datetime;


class Video
{
	use Nette\SmartObject;

	/**
	 * @var string
	 */
	public $id;

	/**
	 * @var string
	 */
	public $title;

	/**
	 * @var string
	 */
	public $description;

	/**
	 * @var datetime
	 */
	public $published;

	/**
	 * @var integer
	 */
	public $views;

	/**
	 * @var string
	 */
	public $url;

	/**
	 * @var
	 */
	public $embed;

	/**
	 * @var array
	 */
	public $thumbs = [
		'default' => null,
		'medium' => null,
		'high' => null,
		'standard' => null,
		'maxres' => null
	];

	/**
	 * @var string ISO 8601
	 */
	public $duration;

	/**
	 * @var array
	 */
	public $tags;


	public function __construct()
	{
		foreach ($this->thumbs as $index => $thumb) {
			$this->thumbs[$index] = new Thumbnail;
		}
	}


	public function hasTag(string $tag): bool
	{
		return array_search($tag, $this->tags, true) !== false;
	}

}
