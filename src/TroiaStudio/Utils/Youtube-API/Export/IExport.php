<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 13.7.18
 * Time: 16:09
 */

namespace TroiaStudio\YoutubeAPI\Export;


use TroiaStudio\YoutubeAPI\Model\Channel;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;


interface IExport
{
	public function video(Video $video): string;

	public function playList(PlayList $playList): string;

	public function channel(Channel $channel): string;
}
