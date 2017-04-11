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
            'httpClient' => null,
            'exception' => true
        ]);

        $builder->addDefinition($this->prefix('troiastudioyoutubeapi'))
            ->setClass('TroiaStudio\YoutubeAPI\Reader', [
                'apiKey' => $config['apiKey'],
                'httpClient' => $config['httpClient'],
                'exception' => $config['exception']
            ]);
    }
}