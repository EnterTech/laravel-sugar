<?php
namespace HyanCat\Sugar\Traits;

use BadMethodCallException;

/**
 * Trait ControllerRoutable
 * @method static route(string $name): string
 */
trait ControllerRoutable
{
    protected static function _route(string $method): string
    {
        if (method_exists(static::class, $method)) {
            return static::class . '@' . $method;
        }
        throw new BadMethodCallException;
    }

    public static function __callStatic($name, $arguments)
    {
        if ($name == 'route') {
            if (empty($arguments)) {
                throw new BadMethodCallException;
            }

            return static::_route($arguments[0]);
        }
    }
}
