<?php
declare(strict_types=1);

namespace TroiaStudioTests\YoutubeAPI;

require_once __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use TroiaStudio\YoutubeAPI\Model;

class Video extends AbstractTestClass
{

	/**
	 * @var Model\Video
	 */
	private $video;


	public function setUp(): void
	{
		parent::setUp();
		$video = new Model\Video();
		$video->id = 'testId';
		$video->thumbs = [];
		$video->views = 2;
		$video->duration = 'd3';
		$video->description = '';
		$video->title = 'Test Title';
		$video->setPublished('2018-11-30 18:33:24');

		$this->video = $video;
	}


	public function testToArray()
	{
		$array = [
			'id' => 'testId',
			'title' => 'Test Title',
			'description' => '',
			'published' => '2018-11-30T18:33:24+01:00',
			'views' => 2,
			'url' => null,
			'embed' => null,
			'thumbs' => [],
			'duration' => 'd3',
			'tags' => [],
		];

		Assert::same($array, $this->video->toArray());
	}
}
(new Video())->run();
