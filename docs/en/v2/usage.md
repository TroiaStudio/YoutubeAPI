# Usage

## Installation

```
$ composer require troiastudio/youtube-api
```

## Configuration

### Basic
```php
$apiKey = 'MySuperSecretYoutubeApiKey';
$youtubeRequest = new \TroiaStudio\YoutubeAPI\Requests\Request($key);
$youtube = new \TroiaStudio\YoutubeAPI\Loader($request, 50);
```

#### Use

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

#### Use

##### Link
```php
$video = $this->youtube->video('https://www.youtube.com/watch?v=qR9Cbu4HAHQ');
$video2 = $this->youtube->video('https://www.youtu.be/watch?v=qR9Cbu4HAHQ');
```

##### Id
```php
$video = $this->youtube->video('qR9Cbu4HAHQ');
```

### Work with video
Every properties you find in [Video documentation](https://github.com/TroiaStudio/YoutubeAPI/blob/master/docs/en/v2/video.md)

**Latte**
```latte
 <h2>{$video->title}</h2>
 <p>{$video->descripton}</p>
 <p>
    <span><a href="{$video->url}">link to youtube</a></span> 
    <span>Video was published {$video->published|date:'d.m.Y H:i:s'}</span>
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
