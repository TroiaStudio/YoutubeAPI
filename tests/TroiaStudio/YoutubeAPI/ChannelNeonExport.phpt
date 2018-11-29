<?php
declare(strict_types=1);

namespace TroiaStudioTests\YoutubeAPI;

require_once __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use TroiaStudio\YoutubeAPI\Loader;
use TroiaStudio\YoutubeAPI\Requests\Request;


class ChannelNeonExport extends AbstractTestClass
{
	public function testCountPlayList(): void
	{
		$request = \Mockery::mock(Request::class, ['SECRET_KEY']);
		$this->setChannelRequestByListOneByOne($request);

		$loader = new Loader($request, 1);
		$channel = $loader->channel('UCpZaOc0uEk9gWh-TS7B3A5g');

		Assert::equal(2, \count($channel->playLists));
	}


	public function testOne(): void
	{
		$request = \Mockery::mock(Request::class, ['SECRET_KEY']);
		$this->setChannelRequest($request);

		$loader = new Loader($request, 7);
		$channel = $loader->channel('UCpZaOc0uEk9gWh-TS7B3A5g');

		$neonExporter = new \TroiaStudio\YoutubeAPI\Export\NeonExport();
		file_put_contents(__DIR__ . '/temp/channel.neon', $neonExporter->channel($channel));

		Assert::same(file_get_contents(__DIR__ . '/files/channel.neon'), file_get_contents(__DIR__ . '/temp/channel.neon'));
	}
}

(new ChannelNeonExport())->run();
