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
namespace Bluz\Application\Helper;

use Bluz\Application\Application;

return
    /**
     * redirect to controller
     *
     * @var Application $this
     * @param string $module
     * @param string $controller
     * @param array $params
     * @return void
     */
    function ($module = 'index', $controller = 'index', $params = array()) {
        $url = $this->getRouter()->url($module, $controller, $params);
        $this->redirect($url);
    };
