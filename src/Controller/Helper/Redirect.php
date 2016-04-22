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
namespace Bluz\Controller\Helper;

use Bluz\Application\Exception\RedirectException;

return
    /**
     * Redirect to URL
     *
     * @param  string $url
     * @return void
     * @throws RedirectException
     */
    function ($url) {
        $redirect = new RedirectException();
        $redirect->setUrl($url);
        throw $redirect;
    };
