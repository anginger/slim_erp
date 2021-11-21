<?php

namespace Slim\Kernel;

class Router
{
    private Context $context;
    private array $routes = [];
    private object $controller;

    public function __construct(
        string        $class,
        public string $root_path = "/",
    )
    {
        $this->context = new Context();
        $this->controller = new $class();
    }

    /**
     * @param string $http_method
     * @param string $path
     * @param string|callable $method
     * @return Router
     */
    public function register(string $http_method, string $path, string|callable $method): self
    {
        $path = !str_starts_with($path, "/") ? "/$path" : $path;
        $path = $this->root_path === "/" ? $path : $this->root_path . $path;
        if (!array_key_exists($path, $this->routes)) {
            $this->routes[$path] = [];
        }
        $this->routes[$path][$http_method] = $method;
        return $this;
    }

    public function run(): void
    {
        $main = function (): ?bool {
            $http_method = $this->getContext()->getRequest()->getMethod();
            $http_path = parse_url($this->getContext()->getRequest()->getRequestUri(), PHP_URL_PATH);
            $http_path = !str_starts_with($http_path, "/") ? "/$http_path" : $http_path;
            $http_path = $this->root_path === "/" ? $http_path : $this->root_path . $http_path;
            if (!array_key_exists($http_path, $this->routes)) return null;
            if (!array_key_exists($http_method, $this->routes[$http_path])) return null;
            // Do middlewares
            // ToDo: call middlewares_before
            // Main
            $method_name = $this->routes[$http_path][$http_method];
            if (!method_exists($this->controller, $method_name)) return false;
            $this->controller->$method_name($this->context);
            // Do middlewares
            // ToDo: call middlewares_after
            return true;
        };
        if (($status = $main()) === null) {
            $this->getContext()->getResponse()->setStatus(404)->setBody(null)->sendJSON();
        } else if ($status === false) {
            $this->getContext()->getResponse()->setStatus(500)->setBody(null)->sendJSON();
        }
    }

    public function getContext(): Context
    {
        return $this->context;
    }
}
