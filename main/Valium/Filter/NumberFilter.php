<?php

namespace Flattens\Valium\Filter
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class NumberFilter implements Filter
	{
		protected $min;
		protected $max;

		public function __construct($min = null, $max = null)
		{
			$this->min = $min;
			$this->max = $max;
		}

		public function validate($data)
		{
			$errors = [];
			$nested = [];

			if (gettype($data) !== 'double' && gettype($data) !== 'integer') $errors[] = new Result\Error('number', null);

			else {
				if ($this->min !== null && $data < $this->min) $errors[] = new Result\Error('min', null);
				if ($this->max !== null && $data > $this->max) $errors[] = new Result\Error('max', null);
			}

			return new Result($errors, $nested);
		}
	}
}
