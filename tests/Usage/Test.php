<?php
//declare(strict_types=1);
//$container = require __DIR__ . '/../../vendor/autoload.php';
//
//\Tracy\Debugger::$maxDepth = 6;
//
//$config = parse_ini_file(__DIR__ . '/../php.ini');
//$key = $config['YT_TOKEN'];
//
//$request = new \TroiaStudio\YoutubeAPI\Requests\Request($key);
//$loader = new \TroiaStudio\YoutubeAPI\Loader($request, 50);
//
//$playList = $loader->playList('PLbXPig9LCIwbjIr5i2aLz3FL6-LZjpVDo');
//
//$video = $loader->video('https://www.youtube.com/embed/zqTyJxGPg-Y');
//
//dump($playList->searchByTag('overwatch'));
//
//dump($playList->searchByTags(['overwatch', 'ow']));
//
//dump($video);
//
//
//dump($playList);
//
//$yamlExporter = new \TroiaStudio\YoutubeAPI\Export\YamlExport();
//$jsonExporter = new \TroiaStudio\YoutubeAPI\Export\JsonExport();
//
////dump($playList->toArray());
//dump($yamlExporter->playList($playList));
//dump($yamlExporter->video($video));
//dump($jsonExporter->playList($playList));
//dump($jsonExporter->video($video));
//
//file_put_contents('test.yaml', $yamlExporter->playList($playList));
