<?php

namespace Flattens\Valium\Filter
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class ObjectFilterTest extends \Flattens\TestCase
	{
		/**
		 * @covers \Flattens\Valium\Filter\ObjectFilter::__construct
		 */
		public function test_construct_0001()
		{
			$filter = new Filter\ObjectFilter('required', 'optional');

			$this->assertAttributeSame('required', 'required', $filter);
			$this->assertAttributeSame('optional', 'optional', $filter);
		}

		/**
		 * @covers \Flattens\Valium\Filter\ObjectFilter::validate
		 */
		public function test_validate_0001()
		{
			$filter = new Filter\ObjectFilter([], []);

			$result[0] = $filter->validate([]);
			$result[1] = $filter->validate([]);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\ObjectFilter::validate
		 */
		public function test_validate_0002()
		{
			$filter = new Filter\ObjectFilter((object) [
				'meta' => \Mockery::mock(),
				'data' => \Mockery::mock(),
			], []);

			$result[0] = $filter->validate([]);
			$result[1] = $filter->validate([]);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());

			$this->assertSame('object', $result[0]->getErrors()[0]->getRule());
			$this->assertSame('object', $result[1]->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\ObjectFilter::validate
		 */
		public function test_validate_0003()
		{
			$filter = new Filter\ObjectFilter([], (object) [
				'meta' => \Mockery::mock()->shouldReceive('validate')->twice()->andReturn(new Result([], []))->getMock(),
				'data' => \Mockery::mock()->shouldReceive('validate')->twice()->andReturn(new Result([], []))->getMock(),
			]);

			$object[0] = (object) ['meta' => null, 'data' => null, 'epic' => null];
			$object[1] = (object) ['meta' => null, 'data' => null, 'epic' => null];

			$result[0] = $filter->validate($object[0]);
			$result[1] = $filter->validate($object[1]);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());

			$this->assertSame('confused', $result[0]->getNested()['epic']->getErrors()[0]->getRule());
			$this->assertSame('confused', $result[1]->getNested()['epic']->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\ObjectFilter::validate
		 */
		public function test_validate_0004()
		{
			$filter = new Filter\ObjectFilter((object) [
				'meta' => \Mockery::mock(),
				'data' => \Mockery::mock(),
			], []);

			$result[0] = $filter->validate((object) []);
			$result[1] = $filter->validate((object) []);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());

			$this->assertSame('required', $result[0]->getNested()['meta']->getErrors()[0]->getRule());
			$this->assertSame('required', $result[1]->getNested()['meta']->getErrors()[0]->getRule());

			$this->assertSame('required', $result[0]->getNested()['data']->getErrors()[0]->getRule());
			$this->assertSame('required', $result[1]->getNested()['data']->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\ObjectFilter::validate
		 */
		public function test_validate_0005()
		{
			$filter = new Filter\ObjectFilter((object) [
				'meta' => \Mockery::mock()->shouldReceive('validate')->twice()->andReturn(new Result([], []))->getMock(),
				'data' => \Mockery::mock()->shouldReceive('validate')->twice()->andReturn(new Result([], []))->getMock(),
			], []);

			$result[0] = $filter->validate((object) ['meta' => null, 'data' => null]);
			$result[1] = $filter->validate((object) ['meta' => null, 'data' => null]);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasPassed());
			$this->assertTrue($result[1]->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\ObjectFilter::validate
		 */
		public function test_validate_0006()
		{
			$filter = new Filter\ObjectFilter((object) [
				'meta' => \Mockery::mock()->shouldReceive('validate')->twice()->andReturn(new Result([new Result\Error('fail', '')], []))->getMock(),
				'data' => \Mockery::mock()->shouldReceive('validate')->twice()->andReturn(new Result([new Result\Error('fail', '')], []))->getMock(),
			], []);

			$result[0] = $filter->validate((object) ['meta' => null, 'data' => null]);
			$result[1] = $filter->validate((object) ['meta' => null, 'data' => null]);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());

			$this->assertSame('fail', $result[0]->getNested()['meta']->getErrors()[0]->getRule());
			$this->assertSame('fail', $result[0]->getNested()['data']->getErrors()[0]->getRule());

			$this->assertSame('fail', $result[1]->getNested()['meta']->getErrors()[0]->getRule());
			$this->assertSame('fail', $result[1]->getNested()['data']->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\ObjectFilter::validate
		 */
		public function test_validate_0007()
		{
			$filter = new Filter\ObjectFilter((object) [], (object) [
				'meta' => \Mockery::mock()->shouldReceive('validate')->twice()->andReturn(new Result([], []))->getMock(),
				'data' => \Mockery::mock()->shouldReceive('validate')->twice()->andReturn(new Result([], []))->getMock(),
			]);

			$result[0] = $filter->validate((object) ['meta' => null, 'data' => null]);
			$result[1] = $filter->validate((object) ['meta' => null, 'data' => null]);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasPassed());
			$this->assertTrue($result[1]->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\ObjectFilter::validate
		 */
		public function test_validate_0008()
		{
			$filter = new Filter\ObjectFilter((object) [], (object) [
				'meta' => \Mockery::mock(),
				'data' => \Mockery::mock(),
			]);

			$result[0] = $filter->validate((object) []);
			$result[1] = $filter->validate((object) []);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasPassed());
			$this->assertTrue($result[1]->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\ObjectFilter::validate
		 */
		public function test_validate_0009()
		{
			$filter = new Filter\ObjectFilter((object) [], (object) [
				'meta' => \Mockery::mock()->shouldReceive('validate')->twice()->andReturn(new Result([new Result\Error('fail', '')], []))->getMock(),
				'data' => \Mockery::mock()->shouldReceive('validate')->twice()->andReturn(new Result([new Result\Error('fail', '')], []))->getMock(),
			]);

			$result[0] = $filter->validate((object) ['meta' => null, 'data' => null]);
			$result[1] = $filter->validate((object) ['meta' => null, 'data' => null]);

			$this->assertInstanceOf(Result::class, $result[0]);
			$this->assertInstanceOf(Result::class, $result[1]);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());

			$this->assertSame('fail', $result[0]->getNested()['meta']->getErrors()[0]->getRule());
			$this->assertSame('fail', $result[0]->getNested()['data']->getErrors()[0]->getRule());

			$this->assertSame('fail', $result[1]->getNested()['meta']->getErrors()[0]->getRule());
			$this->assertSame('fail', $result[1]->getNested()['data']->getErrors()[0]->getRule());
		}
	}
}
