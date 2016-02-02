<?php

namespace Flattens\Valium\Filter\Group
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class OneOfTest extends \Flattens\TestCase
	{
		/**
		 * @covers \Flattens\Valium\Filter\Group\OneOf::__construct
		 */
		public function test_construct_0001()
		{
			$filter = new Filter\Group\OneOf('filters');
			$this->assertAttributeSame('filters', 'filters', $filter);
			$this->assertAttributeSame('filters', 'filters', $filter);
		}

		/**
		 * @covers \Flattens\Valium\Filter\Group\OneOf::validate
		 */
		public function test_validate_0001()
		{
			$filter = new Filter\Group\OneOf([
				\Mockery::mock()
					->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock()
					->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock(),
				\Mockery::mock()
					->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock()
					->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock(),
				\Mockery::mock()
					->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock()
					->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock(),
			]);

			$result[0] = $filter->validate(null);
			$result[1] = $filter->validate(null);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());

			$this->assertSame('oneOf', $result[0]->getErrors()[0]->getRule());
			$this->assertSame('oneOf', $result[1]->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\Group\OneOf::validate
		 */
		public function test_validate_0002()
		{
			$filter = new Filter\Group\OneOf([
				\Mockery::mock()
					->shouldReceive('validate')->once()->andReturn(new Result([new Result\Error('fail', null)], []))->getMock()
					->shouldReceive('validate')->once()->andReturn(new Result([new Result\Error('fail', null)], []))->getMock(),
				\Mockery::mock()
					->shouldReceive('validate')->once()->andReturn(new Result([new Result\Error('fail', null)], []))->getMock()
					->shouldReceive('validate')->once()->andReturn(new Result([new Result\Error('fail', null)], []))->getMock(),
				\Mockery::mock()
					->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock()
					->shouldReceive('validate')->once()->andReturn(new Result([], []))->getMock(),
			]);

			$result[0] = $filter->validate(null);
			$result[1] = $filter->validate(null);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasPassed());
			$this->assertTrue($result[1]->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\Group\OneOf::validate
		 */
		public function test_validate_0003()
		{
			$filter = new Filter\Group\OneOf([
				\Mockery::mock()
					->shouldReceive('validate')->once()->andReturn(new Result([new Result\Error('fail', null)], []))->getMock()
					->shouldReceive('validate')->once()->andReturn(new Result([new Result\Error('fail', null)], []))->getMock(),
				\Mockery::mock()
					->shouldReceive('validate')->once()->andReturn(new Result([new Result\Error('fail', null)], []))->getMock()
					->shouldReceive('validate')->once()->andReturn(new Result([new Result\Error('fail', null)], []))->getMock(),
				\Mockery::mock()
					->shouldReceive('validate')->once()->andReturn(new Result([new Result\Error('fail', null)], []))->getMock()
					->shouldReceive('validate')->once()->andReturn(new Result([new Result\Error('fail', null)], []))->getMock(),
			]);

			$result[0] = $filter->validate(null);
			$result[1] = $filter->validate(null);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());

			$this->assertSame('oneOf', $result[0]->getErrors()[0]->getRule());
			$this->assertSame('oneOf', $result[1]->getErrors()[0]->getRule());
		}
	}
}
