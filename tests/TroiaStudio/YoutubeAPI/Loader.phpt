<?php
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$config = parse_ini_file(__DIR__ . '/../../php.ini');
$apiKey = $config['YT_TOKEN'];

$request = new \TroiaStudio\YoutubeAPI\Requests\Request($apiKey);
$loader = new \TroiaStudio\YoutubeAPI\Loader($request, 50);
$video = $loader->video('zqTyJxGPg-Y');

Assert::true($video instanceof \TroiaStudio\YoutubeAPI\Model\Video);
Assert::same('https://www.youtube.com/watch?v=zqTyJxGPg-Y', $video->url);
Assert::same('https://www.youtube.com/embed/zqTyJxGPg-Y', $video->embed);
Assert::same('PT25S', $video->duration);