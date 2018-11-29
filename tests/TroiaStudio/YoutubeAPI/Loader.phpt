<?php
declare(strict_types=1);

namespace TroiaStudioTests\YoutubeAPI;

require_once __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use TroiaStudio\YoutubeAPI\Requests\Request;


class Loader extends AbstractTestClass
{
	public function testOne(): void
	{
		$request = \Mockery::mock(Request::class, ['SECRET_KEY']);
		$this->setPlayListOverWatch($request, 2);
		$loader = new \TroiaStudio\YoutubeAPI\Loader($request, 2);
		$video = $loader->video('zqTyJxGPg-Y');

		Assert::true($video instanceof \TroiaStudio\YoutubeAPI\Model\Video);
		Assert::same('https://www.youtube.com/watch?v=zqTyJxGPg-Y', $video->url);
		Assert::same('https://www.youtube.com/embed/zqTyJxGPg-Y', $video->embed);
		Assert::same('PT25S', $video->duration);
	}
}

(new Loader())->run();
