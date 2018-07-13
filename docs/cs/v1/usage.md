# Usage

## Instalace

```
$ composer require troiastudio/youtube-api
```

## Konfigurace

### Obyčejné
```php
$apiKey = 'MySuperSecretYoutubeApiKey';
$youtube = new \TroiaStudio\YoutubeAPI\Reader($apiKey);
```

#### Použití

##### Link
```php
$video = $youtube->getVideo('https://www.youtube.com/watch?v=qR9Cbu4HAHQ');
$video2 = $youtube->getVideo('https://www.youtu.be/watch?v=qR9Cbu4HAHQ');
```

##### Id
```php
$video = $youtube->getVideo('qR9Cbu4HAHQ');
```

### Nette

config.neon
```neon
extensions: 
    youtubeAPI: TroiaStudio\YoutubeAPI\DI\Extension

youtubeAPI:
    apiKey: 'MySuperSecretYoutubeApiKey'
```

Presenter
```php
/** @var \TroiaStudio\YoutubeAPI\Reader @inject */
public $youtube;
```

#### Použití

##### Link
```php
$video = $this->youtube->getVideo('https://www.youtube.com/watch?v=qR9Cbu4HAHQ');
$video2 = $this->youtube->getVideo('https://www.youtu.be/watch?v=qR9Cbu4HAHQ');
```

##### Id
```php
$video = $this->youtube->getVideo('qR9Cbu4HAHQ');
```

### Práce s videem
Všechny properties naleznete v [dokumentaci o objektu videa](https://github.com/TroiaStudio/YoutubeAPI/blob/master/docs/cs/video.md)

**Latte**
```latte
 <h2>{$video->title}</h2>
 <p>{$video->descripton}</p>
 <p>
    <span><a href="{$video->url}">odkaz na youtube</a></span> 
    <span>Video bylo publikováno {$video->published|date:'d.m.Y H:i:s'}</span>
 </p>
 <iframe src="{$video->embed}">
 <div>
    <span>{$video->views}</span>
    <div>
        <img src="{$video->thumbs['default']->url}" width="{$video->thumbs['default']->width}" height="{$video->thumbs['default']->height}">
        <img src="{$video->thumbs['medium']->url}" width="{$video->thumbs['medium']->width}" height="{$video->thumbs['medium']->height}">
        <img src="{$video->thumbs['high']->url}" width="{$video->thumbs['high']->width}" height="{$video->thumbs['high']->height}">
    </div>
 </div>
```

