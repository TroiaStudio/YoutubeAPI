<?php
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$config = parse_ini_file(__DIR__ . '/../../php.ini');
$apiKey = $config['YT_TOKEN'];

$reader = new TroiaStudio\YoutubeAPI\Reader($apiKey);
$video = $reader->getVideo('https://youtu.be/kiKZau6XoSc');

Assert::true($video instanceof TroiaStudio\YoutubeAPI\Video);
Assert::same('https://www.youtube.com/watch?v=kiKZau6XoSc', $video->url);
Assert::same('https://www.youtube.com/embed/kiKZau6XoSc', $video->embed);
Assert::same('PT1M35S', $video->duration);