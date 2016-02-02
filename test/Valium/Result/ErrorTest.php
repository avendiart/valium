<?php

namespace Flattens\Valium\Result
{
	use Flattens\Valium\Result;

	class ErrorTest extends \Flattens\TestCase
	{
		/**
		 * @covers \Flattens\Valium\Result\Error::__construct
		 */
		public function test_construct_0001()
		{
			$errors[0] = new Result\Error('rule_0001', 'text_0001');
			$errors[1] = new Result\Error('rule_0002', 'text_0002');

			$this->assertAttributeSame('rule_0001', 'rule', $errors[0]);
			$this->assertAttributeSame('rule_0002', 'rule', $errors[1]);

			$this->assertAttributeSame('text_0001', 'text', $errors[0]);
			$this->assertAttributeSame('text_0002', 'text', $errors[1]);
		}

		/**
		 * @covers \Flattens\Valium\Result\Error::getRule
		 */
		public function test_getRule_0001()
		{
			$errors[0] = new Result\Error('rule_0001', 'text_0001');
			$errors[1] = new Result\Error('rule_0002', 'text_0002');

			$this->assertSame('rule_0001', $errors[0]->getRule());
			$this->assertSame('rule_0002', $errors[1]->getRule());
		}

		/**
		 * @covers \Flattens\Valium\Result\Error::getText
		 */
		public function test_getText_0001()
		{
			$errors[0] = new Result\Error('rule_0001', 'text_0001');
			$errors[1] = new Result\Error('rule_0002', 'text_0002');

			$this->assertSame('text_0001', $errors[0]->getText());
			$this->assertSame('text_0002', $errors[1]->getText());
		}

		/**
		 * @covers \Flattens\Valium\Result\Error::jsonSerialize
		 */
		public function test_jsonSerialize_0001()
		{
			$inputs[0] = ['rule' => 'rule_0001', 'text' => 'text_0001'];
			$inputs[1] = ['rule' => 'rule_0002', 'text' => 'text_0002'];

			$errors[0] = new Result\Error('rule_0001', 'text_0001');
			$errors[1] = new Result\Error('rule_0002', 'text_0002');

			$this->assertJsonStringEqualsJsonString(json_encode($inputs[0]), json_encode($errors[0]));
			$this->assertJsonStringEqualsJsonString(json_encode($inputs[1]), json_encode($errors[1]));
		}
	}
}
