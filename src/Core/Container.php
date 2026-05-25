<?php
declare(strict_types=1);
// File: src/Core/Container.php

namespace App\Core;

class Container {
    private array $bindings = [];
    private array $instances = [];

    public function bind(string $abstract, callable $factory): void {
        $this->bindings[$abstract] = $factory;
    }

    public function make(string $abstract): object {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
        return $this->instances[$abstract] = $this->makeNew($abstract);
    }

    public function makeNew(string $abstract): object {
        if (isset($this->bindings[$abstract])) {
            return ($this->bindings[$abstract])($this);
        }
        
        $reflector = new \ReflectionClass($abstract);
        if (!$reflector->isInstantiable()) {
            throw new \Exception("Class $abstract is not instantiable.");
        }
        
        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return new $abstract();
        }
        
        $parameters = $constructor->getParameters();
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $type = $parameter->getType();
            if ($type && !$type->isBuiltin()) {
                $dependencies[] = $this->make($type->getName());
            } else {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new \Exception("Cannot resolve non-class dependency {$parameter->getName()}");
                }
            }
        }
        
        return $reflector->newInstanceArgs($dependencies);
    }

    public function has(string $abstract): bool {
        return isset($this->bindings[$abstract]) || isset($this->instances[$abstract]);
    }
}
