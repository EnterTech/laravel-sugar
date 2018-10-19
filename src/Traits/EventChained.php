<?php

namespace HyanCat\Sugar\Traits;

/**
 * Trait EventChained
 * @namespace HyanCat\Sugar\Traits
 * @method static $this with(string|array $key, $value = null)
 * @usage
 * 1. EventClass::with('foo', $foo)->with('bar', $bar)->fire();
 * 2. EventClass::event()->with('foo', $foo)->with('bar', $bar)->fire();
 * 3. event(new EventClass());
 */
trait EventChained
{
    public static function event()
    {
        return new static();
    }

    public function fire()
    {
        return event($this);
    }

    private function _with($key, $value = null)
    {
        $data = [];
        if (is_array($key)) {
            $data = $key;
        } else {
            $data[$key] = $value;
        }

        foreach ($data as $k => $v) {
            $this->$k = $v;
        }

        return $this;
    }

    public function __call($name, $arguments)
    {
        if ($name === 'with') {
            return $this->_with(...$arguments);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        return (new static())->$name(...$arguments);
    }
}
