<?php

namespace Flattens\Valium\Filter
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class StringFilterTest extends \Flattens\TestCase
	{
		/**
		 * @covers \Flattens\Valium\Filter\StringFilter::__construct
		 */
		public function test_construct_0001()
		{
			$filter = new Filter\StringFilter('minLength', 'maxLength');

			$this->assertAttributeSame('minLength', 'minLength', $filter);
			$this->assertAttributeSame('maxLength', 'maxLength', $filter);
		}

		/**
		 * @covers \Flattens\Valium\Filter\StringFilter::validate
		 */
		public function test_validate_0001()
		{
			$filter = new Filter\StringFilter(null, null);

			$this->assertInstanceOf(Result::class, $filter->validate('0'));
			$this->assertInstanceOf(Result::class, $filter->validate('1'));

			$this->assertTrue($filter->validate('0')->hasPassed());
			$this->assertTrue($filter->validate('1')->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\StringFilter::validate
		 */
		public function test_validate_0002()
		{
			$filter = new Filter\StringFilter(null, null);

			$this->assertInstanceOf(Result::class, $filter->validate(null));
			$this->assertInstanceOf(Result::class, $filter->validate(null));

			$this->assertTrue($filter->validate(null)->hasFailed());
			$this->assertTrue($filter->validate(null)->hasFailed());

			$this->assertSame('string', $filter->validate(null)->getErrors()[0]->getRule());
			$this->assertSame('string', $filter->validate(null)->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\StringFilter::validate
		 */
		public function test_validate_0003()
		{
			$filter = new Filter\StringFilter(1, null);

			$this->assertInstanceOf(Result::class, $filter->validate('0'));
			$this->assertInstanceOf(Result::class, $filter->validate('1'));

			$this->assertTrue($filter->validate('0')->hasPassed());
			$this->assertTrue($filter->validate('1')->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\StringFilter::validate
		 */
		public function test_validate_0004()
		{
			$filter = new Filter\StringFilter(2, null);

			$this->assertInstanceOf(Result::class, $filter->validate('0'));
			$this->assertInstanceOf(Result::class, $filter->validate('1'));

			$this->assertTrue($filter->validate('0')->hasFailed());
			$this->assertTrue($filter->validate('1')->hasFailed());

			$this->assertSame('minLength', $filter->validate('0')->getErrors()[0]->getRule());
			$this->assertSame('minLength', $filter->validate('1')->getErrors()[0]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Filter\StringFilter::validate
		 */
		public function test_validate_0005()
		{
			$filter = new Filter\StringFilter(null, 1);

			$this->assertInstanceOf(Result::class, $filter->validate('0'));
			$this->assertInstanceOf(Result::class, $filter->validate('1'));

			$this->assertTrue($filter->validate('0')->hasPassed());
			$this->assertTrue($filter->validate('1')->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\StringFilter::validate
		 */
		public function test_validate_0006()
		{
			$filter = new Filter\StringFilter(null, 1);

			$this->assertInstanceOf(Result::class, $filter->validate('01'));
			$this->assertInstanceOf(Result::class, $filter->validate('12'));

			$this->assertTrue($filter->validate('01')->hasFailed());
			$this->assertTrue($filter->validate('12')->hasFailed());

			$this->assertSame('maxLength', $filter->validate('01')->getErrors()[0]->getRule());
			$this->assertSame('maxLength', $filter->validate('12')->getErrors()[0]->getRule());
		}
	}
}
