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


class ChannelRequest
{
	public const LINK_CHANNEL = Loader::LINK . '/channels?id=%s&part=status,snippet,contentDetails&key=%s';

	/**
	 * @var string
	 */
	private $url;

	/**
	 * @var Request
	 */
	private $request;


	public function __construct(string $id, Request $request)
	{
		$this->request = $request;
		$this->url = sprintf(self::LINK_CHANNEL, $id, '%s');
	}

	/**
	 * @return mixed
	 * @throws \Nette\Utils\JsonException
	 */
	public function load()
	{
		return $this->request->getData($this->url);
	}
}
