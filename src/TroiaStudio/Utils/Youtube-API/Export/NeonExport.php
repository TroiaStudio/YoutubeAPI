<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 13.7.18
 * Time: 16:11
 */

namespace TroiaStudio\YoutubeAPI\Export;

use TroiaStudio\YoutubeAPI\Model\Channel;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;
use TroiaStudio\YoutubeAPI\Transformers\NeonTransformer;


class NeonExport implements IExport
{

	/**
	 * @param Video $video
	 * @deprecated use \TroiaStudio\YoutubeAPI\Transformers\NeonTransformer::video
	 * @return string
	 */
	public function video(Video $video): string
	{
		return NeonTransformer::video($video);
	}


	/**
	 * @param PlayList $playList
	 * @deprecated use \TroiaStudio\YoutubeAPI\Transformers\NeonTransformer::playlist
	 * @return string
	 */
	public function playList(PlayList $playList): string
	{
		return NeonTransformer::playlist($playList);
	}


	/**
	 * @param Channel $channel
	 * @deprecated use \TroiaStudio\YoutubeAPI\Transformers\NeonTransformer::channel
	 * @return string
	 */
	public function channel(Channel $channel): string
	{
		return NeonTransformer::channel($channel);
	}


	/**
	 * @deprecated use \TroiaStudio\YoutubeAPI\Transformers\NeonTransformer::save
	 * @param string $path
	 * @param string $filename
	 * @param string $content
	 */
	public static function save(string $path, string $filename, string $content): void
	{
		NeonTransformer::save($path, $filename, $content);
	}
}
