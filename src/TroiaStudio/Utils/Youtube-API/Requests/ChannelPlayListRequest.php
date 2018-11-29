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


class ChannelPlayListRequest
{
	public const LINK_CHANNEL_PLAYLIST = Loader::LINK . '/playlists?channelId=%s&maxResults=%d&part=status,snippet&key=%s',
		  LINK_CHANNEL_PLAYLIST_PAGE = Loader::LINK . '/playlists?channelId=%s&maxResults=%d&part=status,snippet&pageToken=%s&key=%s';

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
		$this->url = sprintf(self::LINK_CHANNEL_PLAYLIST, $id, $maxResults, '%s');
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
		$this->url = sprintf(self::LINK_CHANNEL_PLAYLIST_PAGE, $this->id, $this->maxResults, $pageToken, '%s');
		return $this->load();
	}
}
