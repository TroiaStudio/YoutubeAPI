<?php
declare(strict_types=1);

namespace TroiaStudio\YoutubeAPI\Model\Youtube;


interface Thumbnailable
{

	/**
	 * @return Thumbnail[]
	 */
	public function getThumbnails(): array;
}
