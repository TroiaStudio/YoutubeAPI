<?php
namespace TroiaStudio\YoutubeAPI;

use Nette;
use Composer\CaBundle\CaBundle;
use GuzzleHttp\Client;

class Reader
{
    use Nette\SmartObject;

    //private $link = 'https://www.googleapis.com/youtube/v3/videos';

    private $link = 'https://www.googleapis.com/youtube/v3/videos?key=%s&part=snippet,contentDetails,statistics,status&id=%s';

    /**
     * @var string
     */
    public $apiKey;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    private $videoId;

    /**
     * @var array
     */
    private $videos = [];

    /**
     * @var Video
     */
    public $video;

    /**
     * @var Video
     */
    private $lastVideo;

    /**
	 * @var Client
	 */
    private $httpClient;


    public function __construct($apiKey = null, $httpClient = null)
    {
        if ($apiKey !== null) {
            $this->apiKey = $apiKey;
        }

        if ($httpClient === null) {
            $httpClient = new Client([
                'verify' => CaBundle::getSystemCaRootBundlePath()
            ]);
        }
        $this->httpClient = $httpClient;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        if ($this->isUrl($url)) {
            $id = $this->getVideoId($url);
            if (!$id) {
                throw new \Exception("Probably problem with get id from '{$url}' ");
            }
        } else {
            $id = $url;
        }

        $this->createVideo($this->getData($id), $id);
    }

    private function getVideoId($url)
    {
        $pattern = '#^(?:https?://|//)?(?:www\.|m\.)?(?:youtu\.be/|youtube\.com/(?:embed/|v/|watch\?v=|watch\?.+&v=))([\w-]{11})(?![\w-])#';
        preg_match($pattern, $url, $matches);

        if (isset($matches[1])) {
            $this->videoId = $matches[1];
            return $matches[1];
        }

        return false;
    }

    private function isUrl($url)
    {
        $regex = "(((https?|HTTPS?|ftp)\:)?\/\/)?"; // SCHEME
        $regex .= "([a-zA-Z0-9+!*(),;?&=\$_.-]+(\:[a-zA-Z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass
        $regex .= "([a-zA-Z0-9-.]*)\.([a-zA-Z]{2,3})"; // Host or IP
        $regex .= "(\:[0-9]{2,5})?"; // Port
        $regex .= "(\/([a-zA-Z0-9+\$_-]\.?)+)*\/?"; // Path
        $regex .= "(\?[a-zA-Z+&\$_.-][a-zA-Z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
        $regex .= "(#[a-zA-Z_.-][a-zA-Z0-9+\$_.-]*)?"; // Anchor

        if (preg_match("/^$regex$/", $url)) {
            return TRUE;
        }

        return false;
    }

    public function getVideo($id = null)
    {

        if ($id === null) {
            if ($this->lastVideo === null) {
                $this->setUrl($id);
            }
            return $this->lastVideo;
        }

        if ($this->isUrl($id)) {
            $id = $this->getVideoId($id);
        }

        if (!isset($this->videos[$id])) {
            $this->setUrl($id);
        }

        return $this->videos[$id];
    }


    private function getData($videoId)
    {
        $url = sprintf($this->link, $this->apiKey, $videoId);
        $response = $this->httpClient->get($url, [
           'http_errors' => false,
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \RuntimeException("Unable to parse Youtube video: '{$videoId}' ({$response->getStatusCode()}) {$response->getReasonPhrase()}");
        }
        return $response->getBody()->getContents();
    }


    private function createVideo($data, $videoId)
    {
        $json = Nette\Utils\Json::decode($data);

        if (!isset($json->items[0]->snippet) || !isset($json->items[0]->contentDetails) || !isset($json->items[0]->status) || !isset($json->items[0]->statistics)) {
            throw new \RuntimeException("Empty YouTube response, probably wrong '{$videoId}' video id.");
        }

        $snippet = $json->items[0]->snippet;
        $details = $json->items[0]->contentDetails;
        $statistics = $json->items[0]->statistics;
        $status = $json->items[0]->status;

        $video = new Video;
        $video->id = $videoId;
        $video->title = $snippet->title;
        $video->description = $snippet->description;
        $video->url = 'https://www.youtube.com/watch?v=' . $videoId;
        $video->embed = 'https://www.youtube.com/embed/' . $videoId;
        $video->views = $statistics->viewCount;
        $video->duration = $details->duration;


        $video->published = new Nette\Utils\DateTime($snippet->publishedAt);

        $thumbFormats = [
            'default',
            'medium',
            'high',
            'standard',
            'maxres'
        ];

        foreach ($thumbFormats as $thumb) {
            if (isset($snippet->thumbnails->$thumb)) {
                $video->thumbs[$thumb] = $snippet->thumbnails->$thumb;
            }
        }
        $this->lastVideo = $video;
        $this->videos[$videoId] = $video;
    }
}
