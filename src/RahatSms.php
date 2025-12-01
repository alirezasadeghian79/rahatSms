<?php

namespace rahatSms;

use rahatSms\Contracts\SmsInterface;
use rahatSms\Exceptions\SmsException;

class RahatSms
{
    protected SmsInterface $driver;

    public function driver($name)
    {
        $class = "rahatSms\\Drivers\\" . ucfirst($name);

        if (!class_exists($class)) {
            throw new SmsException("Driver {$name} not found.");
        }

        $this->driver = new $class();

        return $this;
    }

    public function __call($method, $args)
    {
        if (!method_exists($this->driver, $method)) {
            throw new SmsException("Method {$method} not found");
        }

        return $this->driver->$method(...$args);
    }
}
