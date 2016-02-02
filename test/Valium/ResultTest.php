<?php

namespace Flattens\Valium
{
	class ResultTest extends \Flattens\TestCase
	{
		/**
		 * @covers \Flattens\Valium\Result::__construct
		 */
		public function test_construct_0001()
		{
			$inputs[0] = ['errors' => [new Result\Error('rule_0001', 'text_0001')], 'nested' => ['field_0001' => new Result([new Result\Error('rule_0002', 'text_0002')], [])]];
			$inputs[1] = ['errors' => [new Result\Error('rule_0001', 'text_0001')], 'nested' => ['field_0001' => new Result([new Result\Error('rule_0002', 'text_0002')], [])]];

			$result[0] = new Result($inputs[0]['errors'], $inputs[0]['nested']);
			$result[1] = new Result($inputs[1]['errors'], $inputs[1]['nested']);

			$this->assertAttributeSame($inputs[0]['errors'], 'errors', $result[0]);
			$this->assertAttributeSame($inputs[0]['nested'], 'nested', $result[0]);

			$this->assertAttributeSame($inputs[1]['errors'], 'errors', $result[1]);
			$this->assertAttributeSame($inputs[1]['nested'], 'nested', $result[1]);
		}

		/**
		 * @covers \Flattens\Valium\Result::getErrors
		 */
		public function test_getErrors_0001()
		{
			$this->assertSame([], (new Result([], []))->getErrors());
			$this->assertSame([], (new Result([], []))->getErrors());
		}

		/**
		 * @covers \Flattens\Valium\Result::getErrors
		 */
		public function test_getErrors_0002()
		{
			$errors[0] = [new Result\Error('rule_0001', 'text_0001')];
			$errors[1] = [new Result\Error('rule_0002', 'text_0002')];

			$this->assertSame($errors[0], (new Result($errors[0], []))->getErrors());
			$this->assertSame($errors[1], (new Result($errors[1], []))->getErrors());
		}

		/**
		 * @covers \Flattens\Valium\Result::getNested
		 */
		public function test_getNested_0001()
		{
			$this->assertSame([], (new Result([], []))->getNested());
			$this->assertSame([], (new Result([], []))->getNested());
		}

		/**
		 * @covers \Flattens\Valium\Result::getNested
		 */
		public function test_getNested_0002()
		{
			$nested[0] = ['field_0001' => new Result([], []), 'field_0002' => new Result([], [])];
			$nested[1] = ['field_0001' => new Result([], []), 'field_0002' => new Result([], [])];

			$this->assertSame($nested[0], (new Result([], $nested[0]))->getNested());
			$this->assertSame($nested[1], (new Result([], $nested[1]))->getNested());
		}

		/**
		 * @covers \Flattens\Valium\Result::hasFailed
		 */
		public function test_hasFailed_0001()
		{
			$this->assertFalse((new Result([], []))->hasFailed());
			$this->assertFalse((new Result([], []))->hasFailed());
		}

		/**
		 * @covers \Flattens\Valium\Result::hasFailed
		 */
		public function test_hasFailed_0002()
		{
			$this->assertTrue((new Result([new Result\Error('rule_0001', 'text_0001')], []))->hasFailed());
			$this->assertTrue((new Result([new Result\Error('rule_0002', 'text_0002')], []))->hasFailed());
		}

		/**
		 * @covers \Flattens\Valium\Result::hasFailed
		 */
		public function test_hasFailed_0003()
		{
			$this->assertFalse((new Result([], ['field_0001' => new Result([], [])]))->hasFailed());
			$this->assertFalse((new Result([], ['field_0002' => new Result([], [])]))->hasFailed());
		}

		/**
		 * @covers \Flattens\Valium\Result::hasFailed
		 */
		public function test_hasFailed_0004()
		{
			$this->assertTrue((new Result([], ['field_0001' => new Result([new Result\Error('rule_0001', 'text_0001')], [])]))->hasFailed());
			$this->assertTrue((new Result([], ['field_0002' => new Result([new Result\Error('rule_0002', 'text_0002')], [])]))->hasFailed());
		}

		/**
		 * @covers \Flattens\Valium\Result::hasPassed
		 */
		public function test_hasPassed_0001()
		{
			$this->assertTrue((new Result([], []))->hasPassed());
			$this->assertTrue((new Result([], []))->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Result::hasPassed
		 */
		public function test_hasPassed_0002()
		{
			$this->assertFalse((new Result([new Result\Error('rule_0001', 'text_0001')], []))->hasPassed());
			$this->assertFalse((new Result([new Result\Error('rule_0002', 'text_0002')], []))->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Result::hasPassed
		 */
		public function test_hasPassed_0003()
		{
			$this->assertTrue((new Result([], ['field_0001' => new Result([], [])]))->hasPassed());
			$this->assertTrue((new Result([], ['field_0002' => new Result([], [])]))->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Result::hasPassed
		 */
		public function test_hasPassed_0004()
		{
			$this->assertFalse((new Result([], ['field_0001' => new Result([new Result\Error('rule_0001', 'text_0001')], [])]))->hasPassed());
			$this->assertFalse((new Result([], ['field_0002' => new Result([new Result\Error('rule_0002', 'text_0002')], [])]))->hasPassed());
		}

		/**
		 * @covers \Flattens\Valium\Result::jsonSerialize
		 */
		public function test_jsonSerialize_0001()
		{
			$result[0] = ['errors' => [['rule' => 'rule_0001', 'text' => 'text_0001']], 'nested' => ['field_0001' => ['errors' => [['rule' => 'rule_0002', 'text' => 'text_0002']], 'nested' => []]]];
			$result[1] = ['errors' => [['rule' => 'rule_0002', 'text' => 'text_0002']], 'nested' => ['field_0002' => ['errors' => [['rule' => 'rule_0001', 'text' => 'text_0001']], 'nested' => []]]];

			$this->assertJsonStringEqualsJsonString(json_encode($result[0]), json_encode(new Result([new Result\Error('rule_0001', 'text_0001')], ['field_0001' => new Result([new Result\Error('rule_0002', 'text_0002')], [])])));
			$this->assertJsonStringEqualsJsonString(json_encode($result[1]), json_encode(new Result([new Result\Error('rule_0002', 'text_0002')], ['field_0002' => new Result([new Result\Error('rule_0001', 'text_0001')], [])])));
		}

		/**
		 * @covers \Flattens\Valium\Result::toArray
		 */
		public function test_toArray_0001()
		{
			$output[0] = ['errors' => [['rule' => 'rule_0001', 'text' => 'text_0001']], 'nested' => ['field_0001' => ['errors' => [['rule' => 'rule_0002', 'text' => 'text_0002']], 'nested' => []]]];
			$output[1] = ['errors' => [['rule' => 'rule_0002', 'text' => 'text_0002']], 'nested' => ['field_0002' => ['errors' => [['rule' => 'rule_0001', 'text' => 'text_0001']], 'nested' => []]]];

			$result[0] = new Result([new Result\Error('rule_0001', 'text_0001')], ['field_0001' => new Result([new Result\Error('rule_0002', 'text_0002')], [])]);
			$result[1] = new Result([new Result\Error('rule_0002', 'text_0002')], ['field_0002' => new Result([new Result\Error('rule_0001', 'text_0001')], [])]);

			$this->assertSame($result[0]->toArray(), $output[0]);
			$this->assertSame($result[1]->toArray(), $output[1]);
		}
	}
}
