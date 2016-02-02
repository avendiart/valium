<?php

namespace Flattens\Valium\Filter\Group
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class OneOf implements Filter
	{
		protected $filters;

		public function __construct($filters = [])
		{
			$this->filters = $filters;
		}

		public function validate($data)
		{
			$errors = [];
			$nested = [];
			$passed = [];

			foreach ($this->filters as $filter) {
				$result = $filter->validate($data);

				if ($result->hasPassed() == true ||
				    $result->hasFailed() != true) {
					$passed[] = $result;
				}
			}

			if (count($passed) != 1 ||
			    count($passed) != 1) {
				$errors[] = new Result\Error('oneOf', null);
			}

			return new Result(
				$errors,
				$nested
			);
		}
	}
}
