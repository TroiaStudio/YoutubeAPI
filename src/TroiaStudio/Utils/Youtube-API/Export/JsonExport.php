<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: galekj01
 * Date: 13.7.18
 * Time: 16:15
 */

namespace TroiaStudio\YoutubeAPI\Export;


use TroiaStudio\YoutubeAPI\Model\Channel;
use TroiaStudio\YoutubeAPI\Model\PlayList;
use TroiaStudio\YoutubeAPI\Model\Video;
use TroiaStudio\YoutubeAPI\Transformers\JsonTransformer;


class JsonExport implements IExport
{

	/**
	 * @param Video $video
	 * @deprecated use \TroiaStudio\YoutubeAPI\Transformers\JsonTransformer::video
	 * @return string
	 */
	public function video(Video $video): string
	{
		return JsonTransformer::video($video);
	}


	/**
	 * @param PlayList $playList
	 * @deprecated use \TroiaStudio\YoutubeAPI\Transformers\JsonTransformer::playlist
	 * @return string
	 */
	public function playList(PlayList $playList): string
	{
		return JsonTransformer::playlist($playList);
	}


	/**
	 * @param Channel $channel
	 * @deprecated use \TroiaStudio\YoutubeAPI\Transformers\JsonTransformer::channel
	 * @return string
	 */
	public function channel(Channel $channel): string
	{
		return JsonTransformer::channel($channel);
	}


	/**
	 * @deprecated use \TroiaStudio\YoutubeAPI\Transformers\JsonTransformer::save
	 * @param string $path
	 * @param string $filename
	 * @param string $content
	 */
	public static function save(string $path, string $filename, string $content): void
	{
		JsonTransformer::save($path, $filename, $content);
	}
}
