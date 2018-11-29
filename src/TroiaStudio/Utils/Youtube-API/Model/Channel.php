<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 9.7.18
 * Time: 13:55
 */

namespace TroiaStudio\YoutubeAPI\Model;


use Nette\Utils\DateTime;


class Channel implements IModel
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
	 * @var string
	 */
	public $title;

	/**
	 * @var string
	 */
	public $description;

	/**
	 * @var string
	 */
	public $url;

	/**
	 * @var string
	 */
	public $customUrl;

	/**
	 * @var int
	 */
	public $totalResults;

	/**
	 * @var int
	 */
	public $resultsPerPage;

	/**
	 * @var int
	 */
	public $views = 0;

	/**
	 * @var int
	 */
	public $commentCount = 0;

	/**
	 * @var int
	 */
	public $subscriberCount = 0;

	/**
	 * @var bool
	 */
	public $hiddenSubscriberCount = false;

	/**
	 * @var int
	 */
	public $videoCount = 0;

	/**
	 * @var DateTime
	 */
	public $published;

	/**
	 * @var array<string, Thumbnail|null>
	 */
	public $thumbs = [
		'default' => null,
		'medium' => null,
		'high' => null
	];

	/**
	 * @var PlayList[]
	 */
	public $playLists = [];


	public function __construct()
	{

	}

	public function addPlayList(PlayList $playList): void
	{
		$this->playLists[] = $playList;
	}


	public function addThumbnail(string $resolutionName, Thumbnail $thumbnail): void
	{
		$this->thumbs[$resolutionName] = $thumbnail;
	}


	/**
	 * @param string $tag
	 *
	 * @return Video[]
	 */
	public function searchByTag(string $tag): array
	{
		$list = [];
		foreach ($this->playLists as $id => $item) {
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

		$result['published'] = $this->published->format('c');
		foreach ($this->playLists as $index => $playList) {
			$result['playLists'][$playList->id] = $playList->toArray();
			unset($result['playLists'][$index]);
		}

		return $result;
	}
}
