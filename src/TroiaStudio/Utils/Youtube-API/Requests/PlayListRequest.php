<?php
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 9.7.18
 * Time: 16:16
 */

namespace TroiaStudio\YoutubeAPI\Requests;


use TroiaStudio\YoutubeAPI\Loader;


class PlayListRequest
{

	const LINK_PLAYLIST_ITEMS = Loader::LINK . '/playlistItems?playlistId=%s&maxResults=%d&part=status,snippet&key=%s',
		  LINK_PLAYLIST_ITEMS_PAGE = Loader::LINK . '/playlistItems?playlistId=%s&maxResults=%d&part=status,snippet&pageToken=%s&key=%s';

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
	 * @var \TroiaStudio\YoutubeAPI\Requests\Request
	 */
	private $request;


	public function __construct($id, int $maxResults, \TroiaStudio\YoutubeAPI\Requests\Request $request)
	{
		$this->id = $id;
		$this->maxResults = $maxResults;
		$this->request = $request;
		$this->url = sprintf(self::LINK_PLAYLIST_ITEMS, $id, $maxResults, '%s');
	}


	public function load()
	{
		return $this->request->getData($this->url);
	}


	public function loadPage(string $pageToken)
	{
		$this->url = sprintf(self::LINK_PLAYLIST_ITEMS_PAGE, $this->id, $this->maxResults, $pageToken, '%s');
		return $this->load();
	}
}