<?php

namespace Flattens\Valium\Filter
{
	use Flattens\Valium\Filter;
	use Flattens\Valium\Result;

	class ObjectFilter implements Filter
	{
		protected $required;
		protected $optional;

		public function __construct($required = [], $optional = [])
		{
			$this->required = $required;
			$this->optional = $optional;
		}

		public function validate($data)
		{
			$errors = [];
			$nested = [];

			if (gettype($data) !== 'object') $errors[] = new Result\Error('object', null);

			else {

				$properties = array_keys(get_object_vars($data));

				foreach ($properties as $property) {
					if (array_key_exists($property, (array) $this->required) === false &&
					    array_key_exists($property, (array) $this->optional) === false) {
						$nested[$property] = new Result([new Result\Error('confused', null)], []);
					}
				}

				foreach ($this->required as $required => $filter) {

					if (in_array($required, $properties) === false ||
					    in_array($required, $properties) === false) {
						$nested[$required] = new Result([new Result\Error('required', null)], []);
					}

					else {
						$result = $filter->validate($data->$required);

						if ($result->hasFailed() === true ||
						    $result->hasPassed() !== true) {
							$nested[$required] = $result;
						}
					}
				}

				foreach ($this->optional as $optional => $filter) {

					if (in_array($optional, $properties) !== false ||
					    in_array($optional, $properties) !== false) {
						$result = $filter->validate($data->$optional);

						if ($result->hasFailed() === true ||
						    $result->hasPassed() !== true) {
							$nested[$optional] = $result;
						}
					}
				}
			}

			return new Result($errors, $nested);
		}
	}
}
