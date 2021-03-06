<?php
/**
 * Bluz Framework Component
 *
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/framework
 */

/**
 * @namespace
 */
namespace Bluz\Proxy;

use Bluz\Auth\Auth as Instance;
use Bluz\Auth\EntityInterface;

/**
 * Proxy to Auth
 *
 * Example of usage
 *     use Bluz\Proxy\Auth;
 *
 *     $user = Auth::getIdentity();
 *
 * @package  Bluz\Proxy
 * @author   Anton Shevchuk
 *
 * @method   static Instance getInstance()
 *
 * @method   static void setIdentity(EntityInterface $identity)
 * @see      Instance::setIdentity()
 *
 * @method   static EntityInterface getIdentity()
 * @see      Instance::getIdentity()
 *
 * @method   static void clearIdentity()
 * @see      Instance::clearIdentity()
 */
class Auth
{
    use ProxyTrait;

    /**
     * Init instance
     *
     * @return Instance
     */
    protected static function initInstance()
    {
        $instance = new Instance();
        $instance->setOptions(Config::getData('auth'));
        return $instance;
    }
}
