<?php

$container = require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../src/TroiaStudio/Utils/Youtube-API/Reader.php';

use Tracy\Debugger;

Debugger::$maxDepth = 20;
Debugger::enable();

$reader = new TroiaStudio\YoutubeAPI\Reader('');

$video = $reader->getVideo('https://youtu.be/HxfhTDu72VI');

bdump($video);
bdump($video->url);
bdump($video->title);
bdump($video->description);
bdump($video->id);
bdump($video->thumbs);
bdump($video->published);
bdump($video->views);