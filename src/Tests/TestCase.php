<?php
namespace Src\Tests;

use DI\Container;
use Src\App;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
	/** @var Container $container */
	protected $container;

	public function __construct(?string $name = null, array $data = [], $dataName = '')
	{
		parent::__construct(
			$name,
			$data,
			$dataName
		);

		$this->container = App::getContainer();
	}
}