<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model;

use DateTime;
use Nette;


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
	 * @var \DateTime
	 */
	public $published;

	/**
	 * @var int
	 */
	public $views;

	/**
	 * @var string
	 */
	public $url;

	/**
	 * @var string
	 */
	public $embed;

	/**
	 * @var array<string, Thumbnail|null>
	 */
	public $thumbs = [
		'default' => null,
		'medium' => null,
		'high' => null,
		'standard' => null,
		'maxres' => null,
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
	}


	public function hasTag(string $tag): bool
	{
		return array_search($tag, $this->tags, true) !== false;
	}


	private function getProperties(): array
	{
		return get_object_vars($this);
	}


	public function toArray(): array
	{
		$result = $this->getProperties();

		foreach ($this->thumbs as $index => $item) {
			$result['thumbs'][$index] = $item->toArray();
		}

		$result['published'] = $this->published->format('c');

		if (empty($result['tags'])) {
			unset($result['tags']);
		}

		return $result;
	}
}
