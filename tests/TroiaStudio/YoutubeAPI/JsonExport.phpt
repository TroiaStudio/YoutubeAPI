<?php
declare(strict_types=1);

namespace TroiaStudioTests\YoutubeAPI;

require_once __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use TroiaStudio\YoutubeAPI\Requests\Request;


class JsonExport extends AbstractTestClass
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

		$jsonExporter = new \TroiaStudio\YoutubeAPI\Export\JsonExport();

		file_put_contents(__DIR__ . '/temp/json.json', $jsonExporter->playList($playList));

		Assert::same(file_get_contents(__DIR__ . '/files/json.json'), $jsonExporter->playList($playList));
	}
}

(new JsonExport())->run();
