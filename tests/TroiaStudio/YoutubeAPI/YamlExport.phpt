<?php
declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$config = parse_ini_file(__DIR__ . '/../../php.ini');
$apiKey = $config['YT_TOKEN'];

$request = new \TroiaStudio\YoutubeAPI\Requests\Request($apiKey);
$loader = new \TroiaStudio\YoutubeAPI\Loader($request, 7);

$playList = $loader->playList('PLbXPig9LCIwbjIr5i2aLz3FL6-LZjpVDo');

$array = $playList->toArray();

foreach ($array['playlist']['items'] as $index => $value) {
	unset($array['playlist']['items'][$index]['views']);
}

unset($array['playlist']['etag']);

file_put_contents(__DIR__ . '/temp/yaml.yaml', \Symfony\Component\Yaml\Yaml::dump($array, 10));
Assert::same(file_get_contents(__DIR__ . '/files/yaml.yaml'), file_get_contents(__DIR__ . '/temp/yaml.yaml'));
