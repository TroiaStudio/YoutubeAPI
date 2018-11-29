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
use TroiaStudio\YoutubeAPI\Transformers\YamlTransformer;


class YamlExport implements IExport
{

	/**
	 * @param Video $video
	 * @deprecated use \TroiaStudio\YoutubeAPI\Transformers\YamlTransformer::video
	 * @return string
	 */
	public function video(Video $video): string
	{
		return YamlTransformer::video($video);
	}


	/**
	 * @param PlayList $playList
	 * @deprecated use \TroiaStudio\YoutubeAPI\Transformers\YamlTransformer::playlist
	 * @return string
	 */
	public function playList(PlayList $playList): string
	{
		return YamlTransformer::playlist($playList);
	}


	/**
	 * @param Channel $channel
	 * @deprecated use \TroiaStudio\YoutubeAPI\Transformers\YamlTransformer::channel
	 * @return string
	 */
	public function channel(Channel $channel): string
	{
		return YamlTransformer::channel($channel);
	}


	/**
	 * @deprecated use \TroiaStudio\YoutubeAPI\Transformers\YamlTransformer::save
	 * @param string $path
	 * @param string $filename
	 * @param string $content
	 */
	public static function save(string $path, string $filename, string $content): void
	{
		YamlTransformer::save($path, $filename, $content);
	}
}
