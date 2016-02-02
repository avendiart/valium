<?php

namespace Flattens\Valium\Filter
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class NumberFilterTest extends \Flattens\TestCase
	{
		/**
		 * @covers \Flattens\Valium\Filter\NumberFilter::__construct
		 */
		public function test_construct_0001()
		{
			$filter = new Filter\NumberFilter('min', 'max');

			$this->assertAttributeSame('min', 'min', $filter);
			$this->assertAttributeSame('max', 'max', $filter);
		}

		/**
		 * @covers \Flattens\Valium\Filter\NumberFilter::validate
		 */
		public function test_validate_0001()
		{
			$filter = new Filter\NumberFilter(null, null);

			$this->assertInstanceOf(Result::class, $filter->validate(0));
			$this->assertInstanceOf(Result::class, $filter->validate(1));

			$this->assertTrue($filter->validate(0)->hasPassed());
			$this->assertTrue($filter->validate(1)->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\NumberFilter::validate
		 */
		public function test_validate_0002()
		{
			$filter = new Filter\NumberFilter(null, null);

			$this->assertInstanceOf(Result::class, $filter->validate(null));
			$this->assertInstanceOf(Result::class, $filter->validate(null));

			$this->assertTrue($filter->validate(null)->hasFailed());
			$this->assertTrue($filter->validate(null)->hasFailed());

			$this->assertSame('number', $filter->validate(null)->getErrors()[0]->getRule());
			$this->assertSame('number', $filter->validate(null)->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\NumberFilter::validate
		 */
		public function test_validate_0003()
		{
			$filter = new Filter\NumberFilter(0, null);

			$this->assertInstanceOf(Result::class, $filter->validate(0));
			$this->assertInstanceOf(Result::class, $filter->validate(1));

			$this->assertTrue($filter->validate(0)->hasPassed());
			$this->assertTrue($filter->validate(1)->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\NumberFilter::validate
		 */
		public function test_validate_0004()
		{
			$filter = new Filter\NumberFilter(2, null);

			$this->assertInstanceOf(Result::class, $filter->validate(0));
			$this->assertInstanceOf(Result::class, $filter->validate(1));

			$this->assertTrue($filter->validate(0)->hasFailed());
			$this->assertTrue($filter->validate(1)->hasFailed());

			$this->assertSame('min', $filter->validate(0)->getErrors()[0]->getRule());
			$this->assertSame('min', $filter->validate(1)->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\NumberFilter::validate
		 */
		public function test_validate_0005()
		{
			$filter = new Filter\NumberFilter(null, 0);

			$this->assertInstanceOf(Result::class, $filter->validate(-1));
			$this->assertInstanceOf(Result::class, $filter->validate(-2));

			$this->assertTrue($filter->validate(-1)->hasPassed());
			$this->assertTrue($filter->validate(-2)->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\NumberFilter::validate
		 */
		public function test_validate_0006()
		{
			$filter = new Filter\NumberFilter(null, 0);

			$this->assertInstanceOf(Result::class, $filter->validate(1));
			$this->assertInstanceOf(Result::class, $filter->validate(2));

			$this->assertTrue($filter->validate(1)->hasFailed());
			$this->assertTrue($filter->validate(2)->hasFailed());

			$this->assertSame('max', $filter->validate(1)->getErrors()[0]->getRule());
			$this->assertSame('max', $filter->validate(2)->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\NumberFilter::validate
		 */
		public function test_validate_0007()
		{
			$filter = new Filter\NumberFilter(null, null);

			$this->assertInstanceOf(Result::class, $filter->validate(0.1));
			$this->assertInstanceOf(Result::class, $filter->validate(1.1));

			$this->assertTrue($filter->validate(0.1)->hasPassed());
			$this->assertTrue($filter->validate(1.1)->hasPassed());
		}
	}
}
