<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 9.7.18
 * Time: 13:55
 */

namespace TroiaStudio\YoutubeAPI\Model;


use TroiaStudio\YoutubeAPI\Model\Youtube\Playlists;


class PlayList implements IModel
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
	public $items = [];


	public function __construct()
	{
	}


	public static function create(string $id, Playlists $class)
	{
		$playList = new self();
		$playList->id = $id;
		$playList->kind = $class->kind;
		$playList->etag = $class->etag;
		$playList->totalResults = $class->pageInfo->totalResults;
		$playList->resultsPerPage = $class->pageInfo->resultsPerPage;
		return $playList;
	}


	public function addVideo(Video $video): void
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


	public function searchByTags(array $tags): array
	{
		$list = [[]];

		foreach ($tags as $tag) {
			$list[] = $this->searchByTag($tag);
		}

		$list = array_merge(...$list);

		return $list;
	}


	public function searchByTagsStrict(array $items, array $tags): array
	{
		/** @var Video[] $list */
		$list = $items;

		foreach ($list as $id => $item) {
			foreach ($tags as $tag) {
				if (!$item->hasTag($tag)) {
					unset($list[$id]);
				}
			}
		}
		return $list;
	}


	private function getProperties(): array
	{
		return get_object_vars($this);
	}


	public function toArray(): array
	{
		$result = $this->getProperties();

		foreach ($this->items as $index => $item) {
			$result['items'][$item->id] = $this->items[$index]->toArray();
		}

		return $result;
	}
}
