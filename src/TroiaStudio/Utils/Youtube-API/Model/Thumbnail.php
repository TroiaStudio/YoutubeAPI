<?php
namespace TroiaStudio\YoutubeAPI\Model;

class Thumbnail
{
	/**
	 * @var string
	 */
	public $url = '';

	/**
	 * @var integer
	 */
	public $width = 0;

	/**
	 * @var integer
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