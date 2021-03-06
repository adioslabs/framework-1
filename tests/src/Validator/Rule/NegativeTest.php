<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/framework
 */

/**
 * @namespace
 */
namespace Bluz\Tests\Validator\Rule;

use Bluz\Tests;
use Bluz\Validator\Rule\Negative;

/**
 * Class NegativeTest
 * @package Bluz\Tests\Validator\Rule
 */
class NegativeTest extends Tests\TestCase
{
    /**
     * @var \Bluz\Validator\Rule\Negative
     */
    protected $validator;

    /**
     * Setup validator instance
     */
    protected function setUp()
    {
        parent::setUp();
        $this->validator = new Negative();
    }

    /**
     * @dataProvider providerForPass
     */
    public function testNegativeShouldPass($input)
    {
        $this->assertTrue($this->validator->validate($input));
        $this->assertTrue($this->validator->assert($input));
    }

    /**
     * @dataProvider providerForFail
     * @expectedException \Bluz\Validator\Exception\ValidatorException
     */
    public function testNotNegativeNumbersShouldThrowNegativeException($input)
    {
        $this->assertFalse($this->validator->validate($input));
        $this->assertFalse($this->validator->assert($input));
    }

    /**
     * @return array
     */
    public function providerForPass()
    {
        return array(
            ['-1.44'],
            [-1e-5],
            [-10],
        );
    }

    /**
     * @return array
     */
    public function providerForFail()
    {
        return array(
            [0],
            [-0],
            [null],
            [''],
            ['a'],
            [' '],
            ['Foo'],
            [16],
            ['165'],
            [123456],
            [1e10],
        );
    }
}
