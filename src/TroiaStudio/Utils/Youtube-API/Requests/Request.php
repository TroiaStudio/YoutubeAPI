<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 9.7.18
 * Time: 13:47
 */

namespace TroiaStudio\YoutubeAPI\Requests;

use Composer\CaBundle\CaBundle;
use GuzzleHttp\Client;
use Nette\Utils\Json;


class Request
{

	/**
	 * @var string
	 */
	private $apiKey;

	/**
	 * @var Client
	 */
	private $httpClient;


	public function __construct(string $apiKey)
	{
		$this->apiKey = $apiKey;
		$this->httpClient = new Client([
			'verify' => CaBundle::getSystemCaRootBundlePath(),
		]);
	}


	/**
	 * @param string $url
	 *
	 * @return \stdClass
	 * @throws \Nette\Utils\JsonException
	 */
	public function getData(string $url): \stdClass
	{
		$link = sprintf($url, $this->apiKey);
		$response = $this->httpClient->get($link, [
			'http_errors' => false,
		]);

		if ($response->getStatusCode() !== 200) {
			throw new \RuntimeException(sprintf('Unable load data for %s', $url));
		}

		return Json::decode($response->getBody()->getContents());
	}
}
