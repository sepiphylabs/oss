<?php

namespace SepiphyLabs\Oss;

use Closure;
use Nette\Neon\Exception;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    protected $instances = [];
    protected $callbacks = [];

    public function set($id, $instance)
    {
        $this->instances[$id] = $instance;
    }

    public function singleton(string $id, Closure $callback)
    {
        $this->callbacks[$id] = $callback;
    }

    public function has($id)
    {
        return array_key_exists($id, $this->callbacks);
    }

    public function get($id)
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        if (isset($this->callbacks[$id])) {
            return $this->instances[$id] = $this->callbacks[$id]($this);
        }

        throw new class extends Exception implements NotFoundExceptionInterface {};
    }
}
