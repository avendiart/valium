<?php

namespace Flattens\Valium\Filter\Group
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class AllOf implements Filter
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
			$failed = [];

			foreach ($this->filters as $filter) {
				$result = $filter->validate($data);

				if ($result->hasFailed() == true ||
				    $result->hasPassed() != true) {
					$failed[] = $result;
				}
			}

			if (count($failed) >= 1 ||
			    count($failed) >= 1) {
				$errors[] = new Result\Error('allOf', null);
			}

			return new Result(
				$errors,
				$nested
			);
		}
	}
}
