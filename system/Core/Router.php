<?php
namespace System\Core;

use App\Config\Filters;

class Router
{
    private $routes = [];
    private $filters = [];
    private $filtersConfig;

    public function __construct()
    {
        // Load the filter configuration
        $this->filtersConfig = new Filters();
    }

    public function add(string $method, string $route, string $action, array $filters = [])
    {
        $routePattern = $this->convertToRegex($route);
        $this->routes[strtoupper($method)][] = [
            'pattern' => $routePattern,
            'action' => $action,
            'filters' => $filters
        ];
    }

    public function get(string $route, string $action, array $filters = [])
    {
        $this->add('GET', $route, $action, $filters);
    }

    public function post(string $route, string $action, array $filters = [])
    {
        $this->add('POST', $route, $action, $filters);
    }

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

    public function dispatch(string $uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$method])) {
            echo "405 Method Not Allowed";
            return;
        }

        // Apply global 'before' filters
        $this->applyFilters('before');

        foreach ($this->routes[$method] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                // Apply route-specific 'before' filters (if any)
                $this->applyRouteFilters('before', $route['filters']);
                // Call the controller action
                return $this->callAction($route['action'], array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY));
            }
        }

        // Apply global 'after' filters
        $this->applyFilters('after');

        echo "404 Not Found";
    }

    private function applyFilters(string $when)
    {
        foreach ($this->filtersConfig->globals[$when] as $filterAlias) {
            $this->executeFilter($filterAlias);
        }
    }

    private function applyRouteFilters(string $when, array $routeFilters)
    {
        // Check if route-specific filters exist
        if (isset($routeFilters[$when])) {
            // Apply each filter in the route-specific 'before' or 'after' filters
            foreach ($routeFilters[$when] as $filterAlias) {
                $this->executeFilter($filterAlias);
            }
        }
    }

    private function executeFilter(string $filterAlias)
    {
        if (isset($this->filtersConfig->aliases[$filterAlias])) {
            $filterClass = $this->filtersConfig->aliases[$filterAlias];
            $filter = new $filterClass();

            if (method_exists($filter, 'before')) {
                $filter->before();
            }
        } else {
            echo "Filter '$filterAlias' not found.";
        }
    }

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
