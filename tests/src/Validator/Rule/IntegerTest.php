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
use Bluz\Validator\Rule\Integer;

/**
 * Class IntegerTest
 * @package Bluz\Tests\Validator\Rule
 */
class IntegerTest extends Tests\TestCase
{
    /**
     * @var \Bluz\Validator\Rule\Integer
     */
    protected $validator;

    /**
     * Setup validator instance
     */
    protected function setUp()
    {
        $this->validator = new Integer;
    }

    /**
     * @dataProvider providerForPass
     */
    public function testValidIntegersShouldReturnTrue($input)
    {
        $this->assertTrue($this->validator->validate($input));
    }

    /**
     * @dataProvider providerForFail
     */
    public function testInvalidIntegersShouldReturnFalse($input)
    {
        $this->assertFalse($this->validator->validate($input));
    }

    /**
     * @return array
     */
    public function providerForPass()
    {
        return array(
            [16],
            ['165'],
            [123456],
            [PHP_INT_MAX],
        );
    }

    /**
     * @return array
     */
    public function providerForFail()
    {
        return array(
            [null],
            [''],
            [' '],
            ['a'],
            ['Foo'],
            ['1.44'],
            [1e-5],
        );
    }
}
