<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model;


class Thumbnail
{
	/**
	 * @var string
	 */
	public $url = '';

	/**
	 * @var int
	 */
	public $width = 0;

	/**
	 * @var int
	 */
	public $height = 0;


	public function __construct(string $url, int $width, int $height)
	{
		$this->url = $url;
		$this->width = $width;
		$this->height = $height;
	}


	private function getProperties(): array
	{
		return get_object_vars($this);
	}


	public function toArray(): array
	{
		return $this->getProperties();
	}
}
