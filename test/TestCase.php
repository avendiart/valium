<?php

namespace Flattens
{
	class TestCase extends \PHPUnit_Framework_TestCase
	{
		protected function tearDown() { \Mockery::close(); }
	}
}
