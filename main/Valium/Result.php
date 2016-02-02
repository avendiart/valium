<?php

namespace Flattens\Valium
{
	class Result implements \JsonSerializable
	{
		protected $errors;
		protected $nested;

		public function __construct($errors = [], $nested = [])
		{
			$this->errors = $errors;
			$this->nested = $nested;
		}

		public function getErrors()
		{
			return $this->errors;
		}

		public function getNested()
		{
			return $this->nested;
		}

		public function hasFailed()
		{
			return count($this->errors) >= 1 || count(array_filter($this->nested, function($nested) { return $nested->hasFailed(); })) >= 1;
		}

		public function hasPassed()
		{
			return count($this->errors) == 0 && count(array_filter($this->nested, function($nested) { return $nested->hasFailed(); })) == 0;
		}

		public function jsonSerialize()
		{
			return [
				'errors' => $this->errors,
				'nested' => $this->nested,
			];
		}

		public function toArray()
		{
			$json = json_encode($this, JSON_PRESERVE_ZERO_FRACTION);
			$data = json_decode($json, true);

			return $data;
		}
	}
}
