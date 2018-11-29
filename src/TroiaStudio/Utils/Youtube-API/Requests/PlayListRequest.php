<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 9.7.18
 * Time: 16:16
 */

namespace TroiaStudio\YoutubeAPI\Requests;

use TroiaStudio\YoutubeAPI\Loader;
use TroiaStudio\YoutubeAPI\Requests\Request;


class PlayListRequest
{
	public const LINK_PLAYLIST_ITEMS = Loader::LINK . '/playlistItems?playlistId=%s&maxResults=%d&part=status,snippet,contentDetails&key=%s',
		  LINK_PLAYLIST_ITEMS_PAGE = Loader::LINK . '/playlistItems?playlistId=%s&maxResults=%d&part=status,snippet,contentDetails&pageToken=%s&key=%s';

	private $id;

	/**
	 * @var int
	 */
	private $maxResults;

	/**
	 * @var string
	 */
	private $url;

	/**
	 * @var Request
	 */
	private $request;


	public function __construct($id, int $maxResults, Request $request)
	{
		$this->id = $id;
		$this->maxResults = $maxResults;
		$this->request = $request;
		$this->url = sprintf(self::LINK_PLAYLIST_ITEMS, $id, $maxResults, '%s');
	}


	/**
	 * @return \stdClass
	 * @throws \Nette\Utils\JsonException
	 */
	public function load(): \stdClass
	{
		return $this->request->getData($this->url);
	}


	/**
	 * @param string $pageToken
	 *
	 * @return \stdClass
	 * @throws \Nette\Utils\JsonException
	 */
	public function loadPage(string $pageToken): \stdClass
	{
		$this->url = sprintf(self::LINK_PLAYLIST_ITEMS_PAGE, $this->id, $this->maxResults, $pageToken, '%s');
		return $this->load();
	}
}
