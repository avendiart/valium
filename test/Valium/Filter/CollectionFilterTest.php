<?php

namespace Flattens\Valium\Filter
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class CollectionFilterTest extends \Flattens\TestCase
	{
		/**
		 * @covers \Flattens\Valium\Filter\CollectionFilter::__construct
		 */
		public function test_construct_0001()
		{
			$filter = new Filter\CollectionFilter('minItems', 'maxItems', 'items');

			$this->assertAttributeSame('minItems', 'minItems', $filter);
			$this->assertAttributeSame('maxItems', 'maxItems', $filter);
			$this->assertAttributeSame('items', 'items', $filter);
		}

		/**
		 * @covers \Flattens\Valium\Filter\CollectionFilter::validate
		 */
		public function test_validate_0001()
		{
			$filter = new Filter\CollectionFilter(null, null, \Mockery::mock());

			$result[0] = $filter->validate([]);
			$result[1] = $filter->validate([]);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasPassed());
			$this->assertTrue($result[1]->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\CollectionFilter::validate
		 */
		public function test_validate_0002()
		{
			$filter = new Filter\CollectionFilter(null, null, \Mockery::mock());

			$result[0] = $filter->validate(null);
			$result[1] = $filter->validate(null);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());

			$this->assertSame('collection', $result[0]->getErrors()[0]->getRule());
			$this->assertSame('collection', $result[1]->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\CollectionFilter::validate
		 */
		public function test_validate_0003()
		{
			$filter = new Filter\CollectionFilter(2, null, \Mockery::mock()
				->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock()
				->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock()
			);

			$result[0] = $filter->validate([null]);
			$result[1] = $filter->validate([null]);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());

			$this->assertSame('minItems', $result[0]->getErrors()[0]->getRule());
			$this->assertSame('minItems', $result[1]->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\CollectionFilter::validate
		 */
		public function test_validate_0004()
		{
			$filter = new Filter\CollectionFilter(null, 0, \Mockery::mock()
				->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock()
				->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock()
			);

			$result[0] = $filter->validate([null]);
			$result[1] = $filter->validate([null]);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());

			$this->assertSame('maxItems', $result[0]->getErrors()[0]->getRule());
			$this->assertSame('maxItems', $result[1]->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\CollectionFilter::validate
		 */
		public function test_validate_0005()
		{
			$filter = new Filter\CollectionFilter(null, null, \Mockery::mock()
				->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock()
				->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock()
			);

			$result[0] = $filter->validate([null]);
			$result[1] = $filter->validate([null]);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasPassed());
			$this->assertTrue($result[1]->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\CollectionFilter::validate
		 */
		public function test_validate_0006()
		{
			$filter = new Filter\CollectionFilter(null, null, \Mockery::mock()
				->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock()->shouldReceive('validate')->once()->andReturn(new Result([new Result\Error('fail', null)], []))->getMock()
				->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock()->shouldReceive('validate')->once()->andReturn(new Result([new Result\Error('fail', null)], []))->getMock()
			);

			$result[0] = $filter->validate([null, null]);
			$result[1] = $filter->validate([null, null]);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());

			$this->assertSame('fail', $result[0]->getNested()[1]->getErrors()[0]->getRule());
			$this->assertSame('fail', $result[1]->getNested()[1]->getErrors()[0]->getRule());
		}
	}
}
