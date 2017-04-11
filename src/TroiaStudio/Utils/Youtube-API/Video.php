<?php
namespace TroiaStudio\YoutubeAPI;

use Nette;

class Video
{
    use Nette\SmartObject;

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var datetime
     */
    public $published;

    /**
     * @var integer
     */
    public $views;

    /**
     * @var string
     */
    public $url;

    /**
     * @var
     */
    public $embed;

    /**
     * @var array
     */
    public $thumbs = [
        'default' => null,
        'medium' => null,
        'high' => null,
        'standard' => null,
        'maxres' => null
    ];

    public function __construct()
    {
        foreach ($this->thumbs as $index => $thumb) {
            $this->thumbs[$index] = new Thumbnail;
        }
    }
}