# Export

## Json

```php
$jsonExporter = new \TroiaStudio\YoutubeAPI\Export\JsonExport();
$resultVideo = $jsonExporter->video($video); // return string and $video param is Video object
$resultPlayList = $jsonExporter->playList($playList); // return string and $playList param is PlayList object
```

## Yaml

```php
$yamlExporter = new \TroiaStudio\YoutubeAPI\Export\YamlExport();
$resultVideo = $yamlExporter->video($video); // return string and $video param is Video object
$resultPlayList = $yamlExporter->playList($playList); // return string and $playList param is PlayList object
```

## How to save ?

Now you can save easy by:

1)

```php
file_put_contents($file, $resultPlayList);
```

2)

```php
\TroiaStudio\YoutubeAPI\Export\YamlExport::save($path, $filename, $resultPlayList);
// or
\TroiaStudio\YoutubeAPI\Export\JsonExport::save($path, $filename, $resultPlayList);
```
