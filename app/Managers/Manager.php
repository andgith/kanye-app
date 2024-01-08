<?php

namespace App\Managers;

use Exception;

abstract class Manager
{
    /**
     * @throws Exception
     */
    public function driver(string $name = null)
    {
        $name = $name ?: $this->getDefaultDriver();

        return $this->instantiateDriver($name);
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @throws Exception
     */
    public function __call(string $method, array $parameters): mixed
    {
        return $this->driver()->$method(... $parameters);
    }

    /**
     * Make a new driver instance.
     *
     * @throws Exception
     */
    protected function instantiateDriver(string $name): mixed
    {
        $method = 'create' . ucfirst(strtolower($name)) . 'Driver';

        if (! method_exists($this, $method)) {
            throw new Exception("Driver: $name is not supported.");
        }

        return $this->$method();
    }
}
