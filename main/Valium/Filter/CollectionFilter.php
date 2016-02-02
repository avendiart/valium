<?php

namespace Flattens\Valium\Filter
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class CollectionFilter implements Filter
	{
		protected $minItems;
		protected $maxItems;
		protected $items;

		public function __construct($minItems = null, $maxItems = null, $items = null)
		{
			$this->minItems = $minItems;
			$this->maxItems = $maxItems;
			$this->items = $items;
		}

		public function validate($data)
		{
			$errors = [];
			$nested = [];

			if (gettype($data) !== 'array') $errors[] = new Result\Error('collection', null);

			else {
				if ($this->minItems !== null && count($data) < $this->minItems) $errors[] = new Result\Error('minItems', null);
				if ($this->maxItems !== null && count($data) > $this->maxItems) $errors[] = new Result\Error('maxItems', null);

				if ($this->items !== null) {
					$nested = array_filter(array_map(function ($data) { return $this->items->validate($data); }, $data), function ($result) {
						return $result->hasFailed() === true ||
						       $result->hasPassed() !== true;
					});
				}
			}

			return new Result($errors, $nested);
		}
	}
}
