<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 10.4.2017
 * Time: 12:26
 */

namespace TroiaStudio\YoutubeAPI\DI;

use Nette\DI\CompilerExtension;
use TroiaStudio\YoutubeAPI\Loader;
use TroiaStudio\YoutubeAPI\Reader;


class Extension extends CompilerExtension
{
    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();
        $config = $this->getConfig([
            'apiKey' => null,
            'httpClient' => null
        ]);

		$builder->addDefinition($this->prefix('troiastudioyoutubeapi'))
			->setType(Loader::class, [
				'apiKey' => $config['apiKey']
			]);

        $builder->addDefinition($this->prefix('troiastudioyoutubeapi'))
            ->setType(Reader::class, [
                'apiKey' => $config['apiKey'],
                'httpClient' => $config['httpClient']
            ]);
    }
}