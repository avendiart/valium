<?php

namespace Flattens\Valium\Filter
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class StringFilter implements Filter
	{
		protected $minLength;
		protected $maxLength;

		public function __construct($minLength = null, $maxLength = null)
		{
			$this->minLength = $minLength;
			$this->maxLength = $maxLength;
		}

		public function validate($data)
		{
			$errors = [];
			$nested = [];

			if (gettype($data) !== 'string') $errors[] = new Result\Error('string', null);

			else {
				if ($this->minLength !== null && strlen($data) < $this->minLength) $errors[] = new Result\Error('minLength', null);
				if ($this->maxLength !== null && strlen($data) > $this->maxLength) $errors[] = new Result\Error('maxLength', null);
			}

			return new Result($errors, $nested);
		}
	}
}
