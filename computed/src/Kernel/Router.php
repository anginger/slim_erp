<?php

namespace Slim\Kernel;

use Slim\Controllers\ControllerInterface;
use Slim\Middlewares\MiddlewareInterface;
use TypeError;

class Router
{
    private Context $context;
    private array $routes = [];
    private array $middlewares_before = [];
    private array $middlewares_after = [];
    private ControllerInterface $controller;

    public function __construct(
        public string $class,
        public string $root_path = "/",
    )
    {
        $this->context = new Context();
        $this->controller = new $class();
    }

    public function getContext(): Context
    {
        return $this->context;
    }

    public function addMiddleware(bool $type, string $controller): static
    {
        $instance = new $controller();
        if (!($instance instanceof MiddlewareInterface)) {
            throw new TypeError();
        }
        if ($type) {
            $this->middlewares_before[$controller] = $instance;
        } else {
            $this->middlewares_after[$controller] = $instance;
        }
        return $this;
    }

    public function deleteMiddleware(bool $type, string $controller): static
    {
        if ($type) {
            unset($this->middlewares_before[$controller]);
        } else {
            unset($this->middlewares_after[$controller]);
        }
        return $this;
    }

    private function executeMiddleware(bool $type, Context $context): void
    {
        $middlewares = $type ? $this->middlewares_before : $this->middlewares_after;
        foreach ($middlewares as $middleware) {
            if (is_null($middleware)) continue;
            assert($middleware instanceof MiddlewareInterface);
            $middleware::toUse($context);
        }
    }

    /**
     * @param string $http_method
     * @param string $path
     * @param string|callable $method
     * @return Router
     */
    public function register(string $http_method, string $path, string|callable $method): static
    {
        $path = !empty($path) && !str_starts_with($path, "/") ? "/$path" : $path;
        $path = $this->root_path === "/" ? $path : $this->root_path . $path;
        if (!array_key_exists($path, $this->routes)) {
            $this->routes[$path] = [];
        }
        $this->routes[$path][$http_method] = $method;
        return $this;
    }

    public function run(bool $single_controller = false): void
    {
        $main = function (): ?bool {
            $http_method = $this->getContext()->getRequest()->getMethod();
            $http_path = parse_url($this->getContext()->getRequest()->getRequestUri(), PHP_URL_PATH);
            $http_path = !str_starts_with($http_path, "/") ? "/$http_path" : $http_path;
            if (!array_key_exists($http_path, $this->routes)) return null;
            if (!array_key_exists($http_method, $this->routes[$http_path])) return null;
            // Do middlewares
            $this->executeMiddleware(false, $this->getContext());
            // Main
            $method_name = $this->routes[$http_path][$http_method];
            if (!method_exists($this->controller, $method_name)) return false;
            $this->controller->$method_name($this->getContext());
            // Do middlewares
            $this->executeMiddleware(true, $this->getContext());
            return true;
        };
        $status = $main();
        if ($single_controller) {
            if ($status === null) {
                $this->getContext()->getResponse()->setStatus(404)->setBody(null)->sendJSON();
            } else if ($status === false) {
                $this->getContext()->getResponse()->setStatus(500)->setBody(null)->sendJSON();
            }
        }
    }
}
