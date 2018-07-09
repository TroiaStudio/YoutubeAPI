<?php
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 9.7.18
 * Time: 13:55
 */

namespace TroiaStudio\YoutubeAPI\Model;


use TroiaStudio\YoutubeAPI\Video;


class PlayList
{

	/**
	 * @var string
	 */
	public $id;

	/**
	 * @var string
	 */
	public $kind;

	/**
	 * @var string
	 */
	public $etag;

	/**
	 * @var int
	 */
	public $totalResults;

	/**
	 * @var int
	 */
	public $resultsPerPage;

	/**
	 * @var Video[]
	 */
	public $items;


	public function __construct(string $id, \stdClass $class)
	{
		$this->id = $id;
		$this->kind = $class->kind;
		$this->etag = $class->etag;
		$this->totalResults = $class->pageInfo->totalResults;
		$this->resultsPerPage = $class->pageInfo->resultsPerPage;
	}


	public function addVideo(Video $video)
	{
		$this->items[$video->id] = $video;
	}


	/**
	 * @param string $tag
	 *
	 * @return Video[]
	 */
	public function searchByTag(string $tag): array
	{
		$list = [];
		foreach ($this->items as $id => $item) {
			if ($item->hasTag($tag)) {
				$list[$id] = $item;
			}
		}
		return $list;
	}

}