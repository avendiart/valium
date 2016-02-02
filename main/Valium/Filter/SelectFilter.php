<?php

namespace Flattens\Valium\Filter
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class SelectFilter implements Filter
	{
		protected $items;

		public function __construct($items = null)
		{
			$this->items = $items;
		}

		public function validate($data)
		{
			$errors = [];
			$nested = [];

			if ($this->items !== null ||
			    $this->items !== null) {

				$match = array_filter($this->items, function ($item) use ($data) {
					return $data === $item;
				});

				if (count($match) === 0 ||
				    count($match) === 0) {
					$errors[] = new Result\Error('select', null);
				}
			}

			return new Result($errors, $nested);
		}
	}
}
