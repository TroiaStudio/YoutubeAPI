# Usage

## Instalace

```
$ composer require troiastudio/youtube-api
```

## Konfigurace

### Obyčejné
```php
$apiKey = 'MySuperSecretYoutubeApiKey';
$youtubeRequest = new \TroiaStudio\YoutubeAPI\Requests\Request($key);
$youtube = new \TroiaStudio\YoutubeAPI\Loader($request, 50);
```

#### Použití

##### Link
```php
$video = $youtube->video('https://www.youtube.com/watch?v=qR9Cbu4HAHQ');
$video2 = $youtube->video('https://www.youtu.be/watch?v=qR9Cbu4HAHQ');
```

##### Id
```php
$video = $youtube->video('qR9Cbu4HAHQ');
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
/** @var \TroiaStudio\YoutubeAPI\Loader @inject */
public $youtube;
```

#### Použití

##### Link
```php
$video = $this->youtube->video('https://www.youtube.com/watch?v=qR9Cbu4HAHQ');
$video2 = $this->youtube->video('https://www.youtu.be/watch?v=qR9Cbu4HAHQ');
```

##### Id
```php
$video = $this->youtube->video('qR9Cbu4HAHQ');
```

### Práce s videem
Všechny properties naleznete v [dokumentaci o objektu videa](https://github.com/TroiaStudio/YoutubeAPI/blob/master/docs/cs/v2/video.md)

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

