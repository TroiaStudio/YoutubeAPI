<?php
/**
 * Created by PhpStorm.
 * User: Galek
 * Date: 10.4.2017
 * Time: 12:26
 */

namespace TroiaStudio\YoutubeAPI\DI;

use Nette\DI\Compiler;
use Nette\DI\CompilerExtension;

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
            ->setClass('TroaiaStudio\YoutubeAPI\Reader', [
               'apiKey' => $config['apikey'],
                'httpClient' => $config['httpClient']
            ]);
    }
}