<?php
declare(strict_types=1);

use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$config = parse_ini_file(__DIR__ . '/../../php.ini');
$apiKey = $config['YT_TOKEN'];

$request = new \TroiaStudio\YoutubeAPI\Requests\Request($apiKey);
$loader = new \TroiaStudio\YoutubeAPI\Loader($request, 7);

$playList = $loader->playList('PLbXPig9LCIwbjIr5i2aLz3FL6-LZjpVDo');

unset($playList->etag);

foreach ($playList->items as $index => $video) {
	unset($video->views);
}

$neonExporter = new \TroiaStudio\YoutubeAPI\Export\NeonExport();

file_put_contents(__DIR__ . '/temp/neon.neon', $neonExporter->playList($playList));

Assert::same(file_get_contents(__DIR__ . '/files/neon.neon'), file_get_contents(__DIR__ . '/temp/neon.neon'));
