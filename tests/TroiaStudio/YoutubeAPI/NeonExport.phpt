<?php
declare(strict_types=1);

namespace TroiaStudioTests\YoutubeAPI;

require_once __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use TroiaStudio\YoutubeAPI\Requests\Request;


class NeonExport extends AbstractTestClass
{
	public function testOne(): void
	{
		$request = \Mockery::mock(Request::class, ['SECRET_KEY']);
		$this->setPlayListOverWatch($request, 2);
		$loader = new \TroiaStudio\YoutubeAPI\Loader($request, 2);

		$playList = $loader->playList('PLbXPig9LCIwbjIr5i2aLz3FL6-LZjpVDo');

		unset($playList->etag);

		foreach ($playList->items as $index => $video) {
			unset($video->views);
		}

		$neonExporter = new \TroiaStudio\YoutubeAPI\Export\NeonExport();

		file_put_contents(__DIR__ . '/temp/neon.neon', $neonExporter->playList($playList));

		Assert::same(file_get_contents(__DIR__ . '/files/neon.neon'), file_get_contents(__DIR__ . '/temp/neon.neon'));
	}
}

(new NeonExport())->run();
