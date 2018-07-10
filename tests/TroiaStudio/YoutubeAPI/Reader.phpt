<?php
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$config = parse_ini_file(__DIR__ . '/../../php.ini');
$apiKey = $config['YT_TOKEN'];

$reader = new TroiaStudio\YoutubeAPI\Reader($apiKey);
$video = $reader->getVideo('https://youtu.be/pOiQOOrj-fY');

Assert::true($video instanceof TroiaStudio\YoutubeAPI\Video);
Assert::same('https://www.youtube.com/watch?v=pOiQOOrj-fY', $video->url);
Assert::same('https://www.youtube.com/embed/pOiQOOrj-fY', $video->embed);
Assert::same('PT1M35S', $video->duration);