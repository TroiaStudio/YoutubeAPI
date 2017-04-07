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
    public $thumbs;
}