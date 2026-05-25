<?php
declare(strict_types=1);
// File: src/Core/Router.php

namespace App\Core;

class Router {
    private array $routes = [];
    private array $middlewareAliases = [];
    private array $currentGroupMiddleware = [];
    private string $currentGroupPrefix = '';

    public function __construct(private Container $container) {}

    public function addMiddleware(string $alias, string $class): self {
        $this->middlewareAliases[$alias] = $class;
        return $this;
    }

    public function get(string $path, array|callable $handler): self {
        $fullPath = rtrim($this->currentGroupPrefix . $path, '/') ?: '/';
        $this->routes[] = ['method' => 'GET', 'path' => $fullPath, 'handler' => $handler, 'middleware' => $this->currentGroupMiddleware];
        return $this;
    }

    public function post(string $path, array|callable $handler): self {
        $fullPath = rtrim($this->currentGroupPrefix . $path, '/') ?: '/';
        $this->routes[] = ['method' => 'POST', 'path' => $fullPath, 'handler' => $handler, 'middleware' => $this->currentGroupMiddleware];
        return $this;
    }

    public function put(string $path, array|callable $handler): self {
        $fullPath = rtrim($this->currentGroupPrefix . $path, '/') ?: '/';
        $this->routes[] = ['method' => 'PUT', 'path' => $fullPath, 'handler' => $handler, 'middleware' => $this->currentGroupMiddleware];
        return $this;
    }

    public function patch(string $path, array|callable $handler): self {
        $fullPath = rtrim($this->currentGroupPrefix . $path, '/') ?: '/';
        $this->routes[] = ['method' => 'PATCH', 'path' => $fullPath, 'handler' => $handler, 'middleware' => $this->currentGroupMiddleware];
        return $this;
    }

    public function delete(string $path, array|callable $handler): self {
        $fullPath = rtrim($this->currentGroupPrefix . $path, '/') ?: '/';
        $this->routes[] = ['method' => 'DELETE', 'path' => $fullPath, 'handler' => $handler, 'middleware' => $this->currentGroupMiddleware];
        return $this;
    }

    // CONTRACT: group() MUST save previous $currentGroupMiddleware and $currentGroupPrefix state,
    // apply child overrides from $options, invoke $callback($this), then restore previous state.
    public function group(array $options, callable $callback): void {
        $previousPrefix = $this->currentGroupPrefix;
        $previousMiddleware = $this->currentGroupMiddleware;

        if (isset($options['prefix'])) {
            $this->currentGroupPrefix .= $options['prefix'];
        }
        if (isset($options['middleware'])) {
            $this->currentGroupMiddleware = array_merge($this->currentGroupMiddleware, (array)$options['middleware']);
        }

        $callback($this);

        $this->currentGroupPrefix = $previousPrefix;
        $this->currentGroupMiddleware = $previousMiddleware;
    }

    public function dispatch(Request $request): void {
        $method = $request->method();
        $uri = $request->uri();

        foreach ($this->routes as $route) {
            if ($route['method'] === $method) {
                $params = $this->matchRoute($route['path'], $uri);
                if ($params !== false) {
                    $request->setRouteParams($params);
                    if ($this->runMiddlewarePipeline($route['middleware'], $request)) {
                        $this->runHandler($route['handler'], $request);
                    }
                    return;
                }
            }
        }
        
        throw new \App\Exceptions\NotFoundException();
    }

    // CONTRACT: If alias string contains argument (e.g. "role:admin"),
    // resolve middleware with: new ClassName(argument).
    // If alias has no argument, resolve through container.
    private function resolveMiddleware(string $alias): object {
        $parts = explode(':', $alias, 3);
        $name = $parts[0];
        $arg = $parts[1] ?? null;

        if (!isset($this->middlewareAliases[$name])) {
            throw new \RuntimeException("Middleware alias {$name} not found");
        }

        $class = $this->middlewareAliases[$name];
        
        if ($arg !== null) {
            return new $class($arg);
        }
        
        return $this->container->make($class);
    }

    private function matchRoute(string $pattern, string $uri): array|false {
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[^/]+)', $pattern);
        $pattern = '#^' . $pattern . '$#';
        
        if (preg_match($pattern, $uri, $matches)) {
            $params = [];
            foreach ($matches as $key => $value) {
                if (is_string($key)) {
                    $params[$key] = $value;
                }
            }
            return $params;
        }
        return false;
    }

    private function runMiddlewarePipeline(array $middlewareList, Request $request): bool {
        foreach ($middlewareList as $alias) {
            $middleware = $this->resolveMiddleware($alias);
            if (!$middleware->handle($request)) {
                return false;
            }
        }
        return true;
    }

    private function runHandler(array|callable $handler, Request $request): void {
        if (is_callable($handler)) {
            call_user_func($handler, $request);
        } elseif (is_array($handler)) {
            [$class, $method] = $handler;
            $controller = $this->container->make($class);
            $controller->$method($request);
        }
    }
}
