<?php

namespace Flattens\Valium\Result
{
	class Error implements \JsonSerializable
	{
		protected $rule;
		protected $text;

		public function __construct($rule = '', $text = '')
		{
			$this->rule = $rule;
			$this->text = $text;
		}

		public function getRule()
		{
			return $this->rule;
		}

		public function getText()
		{
			return $this->text;
		}

		public function jsonSerialize()
		{
			return [
				'rule' => $this->rule,
				'text' => $this->text,
			];
		}
	}
}
