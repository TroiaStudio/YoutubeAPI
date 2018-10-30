<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 10.4.2017
 * Time: 12:26
 */

namespace TroiaStudio\YoutubeAPI\DI;

use Nette\DI\CompilerExtension;
use TroiaStudio\YoutubeAPI\Loader;
use TroiaStudio\YoutubeAPI\Requests\Request;


class Extension extends CompilerExtension
{
	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig([
			'apiKey' => null,
			'maxResults' => 50,
		]);

		$builder->addDefinition($this->prefix('troiastudioyoutubeapi'))
			->setClass(Request::class, [
				'apiKey' => $config['apiKey'],
			]);

		$builder->addDefinition($this->prefix('troiastudioyoutubeapi'))
			->setClass(Loader::class, [
				'maxResults' => $config['maxResults'],
			]);
	}
}
