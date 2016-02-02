<?php

namespace Flattens\Valium\Filter
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class SelectFilterTest extends \Flattens\TestCase
	{
		/**
		 * @covers \Flattens\Valium\Filter\SelectFilter::__construct
		 */
		public function test_construct_0001()
		{
			$filter = new Filter\SelectFilter('items');

			$this->assertAttributeSame('items', 'items', $filter);
			$this->assertAttributeSame('items', 'items', $filter);
		}

		/**
		 * @covers \Flattens\Valium\Filter\SelectFilter::validate
		 */
		public function test_validate_0001()
		{
			$filter = new Filter\SelectFilter([0, 1]);

			$this->assertInstanceOf(Result::class, $filter->validate(0));
			$this->assertInstanceOf(Result::class, $filter->validate(1));

			$this->assertTrue($filter->validate(0)->hasPassed());
			$this->assertTrue($filter->validate(1)->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Filter\SelectFilter::validate
		 */
		public function test_validate_0002()
		{
			$filter = new Filter\SelectFilter([]);

			$this->assertInstanceOf(Result::class, $filter->validate(0));
			$this->assertInstanceOf(Result::class, $filter->validate(1));

			$result[0] = $filter->validate(0);
			$result[1] = $filter->validate(1);

			$this->assertTrue($result[0]->hasFailed());
			$this->assertTrue($result[1]->hasFailed());

			$this->assertSame('select', $result[0]->getErrors()[0]->getRule());
			$this->assertSame('select', $result[1]->getErrors()[0]->getRule());
		}
	}
}
