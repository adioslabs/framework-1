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
namespace Bluz\View\Helper;

use Bluz\Application\Exception\ForbiddenException;
use Bluz\Controller\Controller;
use Bluz\Proxy\Request;
use Bluz\Proxy\Router;
use Bluz\View\View;
use Bluz\View\ViewException;

/**
 * Generate URL
 *
 * @param  string $module
 * @param  string $controller
 * @param  array  $params
 * @param  bool   $checkAccess
 * @return null|string
 * @throws ViewException
 */
return
    function ($module, $controller, $params = [], $checkAccess = false) {
        /**
         * @var View $this
         */
        try {
            if ($checkAccess) {
                try {
                    $controllerInstance = new Controller($module, $controller);
                    $controllerInstance->checkPrivilege();
                } catch (ForbiddenException $e) {
                    return null;
                }
            }
        } catch (\Exception $e) {
            throw new ViewException('Url View Helper: ' . $e->getMessage());
        }

        if (null === $module) {
            $module = Request::getModule();
        }
        if (null === $controller) {
            $controller = Request::getController();
        }
        if (null === $params) {
            $params = Request::getParams();
        }

        return Router::getUrl($module, $controller, $params);
    };
