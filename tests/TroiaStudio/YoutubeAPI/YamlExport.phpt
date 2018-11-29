<?php
declare(strict_types=1);

namespace TroiaStudioTests\YoutubeAPI;

require_once __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use TroiaStudio\YoutubeAPI\Requests\Request;


class YamlExport extends AbstractTestClass
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

		$yamlExporter = new \TroiaStudio\YoutubeAPI\Export\YamlExport();

		file_put_contents(__DIR__ . '/temp/yaml.yaml', $yamlExporter->playList($playList));

		Assert::same(file_get_contents(__DIR__ . '/files/yaml.yaml'), file_get_contents(__DIR__ . '/temp/yaml.yaml'));
	}
}

(new YamlExport())->run();
