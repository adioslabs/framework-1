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
namespace Bluz\Controller\Mapper;

use Bluz\Application\Exception\ForbiddenException;
use Bluz\Application\Exception\NotImplementedException;

/**
 * Rest
 *
 * @package  Bluz\Rest
 * @author   Anton Shevchuk
 */
class Rest extends AbstractMapper
{
    /**
     * Run REST controller
     * @return mixed
     * @throws ForbiddenException
     * @throws NotImplementedException
     */
    public function run()
    {
        $params = $this->params;

        if (sizeof($params)) {
            $this->primary = explode('-', array_shift($params));
        }
        if (sizeof($params)) {
            $this->relation = array_shift($params);
        }
        if (sizeof($params)) {
            $this->relationId = array_shift($params);
        }

        // OPTIONS
        if ('OPTIONS' == $this->method) {
            $this->data = array_keys($this->map);
        }

        // dispatch controller
        return parent::run();
    }
}
