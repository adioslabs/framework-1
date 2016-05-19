<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

/**
 * @namespace
 */
namespace Bluz\Tests\Controller;

use Bluz\Controller;
use Bluz\Tests\TestCase;

/**
 * @package  Bluz\Tests
 * @author   Anton Shevchuk
 * @created  19.05.16 12:28
 */
class ControllerTest extends TestCase
{

    /**
     * @var Controller\Controller
     */
    protected $controller;
    
    /**
     * Create `index/index` controller
     */
    public function setUp()
    {
        $this->controller = $this->getApp()->dispatch('index', 'index');
    }
    
    /**
     * Close all
     */
    public function tearDown()
    {
        
    }

    /**
     * Test Helper Denied
     *
     * @expectedException \Bluz\Application\Exception\ForbiddenException
     */
    public function testHelperDenied()
    {
        $this->controller->denied();
    }

    /**
     * Test Helper User
     */
    public function testHelperUser()
    {
        $result = $this->controller->user();
        $this->assertNull($result);
    }
}
