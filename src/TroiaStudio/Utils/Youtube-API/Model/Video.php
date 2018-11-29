<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model;

use DateTime;


class Video implements IModel
{

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
	 * @var DateTime
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
	 * @var Thumbnail[]|array<string, null>
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
	public $tags = [];


	public function __construct()
	{
	}


	public function addThumbnail(string $resolutionName, Thumbnail $thumbnail): void
	{
		$this->thumbs[$resolutionName] = $thumbnail;
	}


	public function hasTag(string $tag): bool
	{
		return \in_array($tag, $this->tags, true);
	}


	private function getProperties(): array
	{
		return get_object_vars($this);
	}


	public function toArray(): array
	{
		$result = $this->getProperties();

		foreach ($this->thumbs as $index => $item) {
			if (!($item instanceof Thumbnail)) {
				continue;
			}
			$result['thumbs'][$index] = $item->toArray();
		}

		$result['published'] = $this->published->format('c');

		return $result;
	}


	/**
	 * @param string $published
	 *
	 * @throws \Exception
	 */
	public function setPublished(string $published): void
	{
		$this->published = new DateTime($published);
	}
}
