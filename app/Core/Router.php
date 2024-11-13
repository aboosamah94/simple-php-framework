<?php
namespace App\Core;

class Router
{
    private $routes = [];

    // Add a route to the router, supporting HTTP methods and dynamic parameters
    public function add(string $method, string $route, string $action)
    {
        $routePattern = $this->convertToRegex($route);
        $this->routes[strtoupper($method)][] = ['pattern' => $routePattern, 'action' => $action];
    }

    // Helper method to define GET routes
    public function get(string $route, string $action)
    {
        $this->add('GET', $route, $action);
    }

    // Helper method to define POST routes
    public function post(string $route, string $action)
    {
        $this->add('POST', $route, $action);
    }

    // Convert a route with parameters to a regex pattern
    private function convertToRegex(string $route): string
    {
        $routePattern = preg_replace_callback('/\{([^\/\?]+)(\?)?\}/', function ($matches) {
            if (isset($matches[2]) && $matches[2] === '?') {
                return '(?P<' . $matches[1] . '>[^/]+)?';
            }
            return '(?P<' . $matches[1] . '>[^/]+)';
        }, $route);
        $routePattern = str_replace('/', '\/', $routePattern);
        return '/^' . $routePattern . '\/?$/';
    }


    // Dispatch the request to the appropriate controller and method
    public function dispatch(string $uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$method])) {
            echo "405 Method Not Allowed";
            return;
        }

        foreach ($this->routes[$method] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                return $this->callAction($route['action'], array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY));
            }
        }

        echo "404 Not Found";
    }

    // Call the controller and method with optional parameters
    private function callAction(string $action, array $params = [])
    {
        list($controller, $method) = explode('::', $action);
        $controller = "App\\Controllers\\" . $controller . "Controller";

        if (class_exists($controller)) {
            $controllerInstance = new $controller();

            if (method_exists($controllerInstance, $method)) {
                call_user_func_array([$controllerInstance, $method], $params);
            } else {
                echo "Method $method not found in controller $controller";
            }
        } else {
            echo "Controller $controller not found";
        }
    }
}
