<?php

namespace Flattens\Valium\Filter\Group
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class AnyOf implements Filter
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

			if (count($passed) == 0 ||
			    count($passed) == 0) {
				$errors[] = new Result\Error('anyOf', null);
			}

			return new Result(
				$errors,
				$nested
			);
		}
	}
}
