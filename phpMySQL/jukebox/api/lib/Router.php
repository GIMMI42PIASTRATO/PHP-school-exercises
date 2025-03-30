<?php

declare(strict_types=1);

class Router
{
    private static array $routes = [];

    // GET route
    public static function get(string $route, callable $callback)
    {
        self::addRoute("GET", $route, $callback);
    }

    // POST route
    public static function post(string $route, callable $callback)
    {
        self::addRoute("POST", $route, $callback);
    }

    // PUT route
    public static function put(string $route, callable $callback)
    {
        self::addRoute("PUT", $route, $callback);
    }

    // DELETE route
    public static function delete(string $route, callable $callback)
    {
        self::addRoute("DELETE", $route, $callback);
    }

    // append a new route to the routes array
    private static function addRoute(string $method, string $route, callable $callback)
    {
        self::$routes[] = [
            "method" => $method,
            "route" => $route,
            "callback" => $callback,
        ];
    }

    // Execute the URI matching route
    public static function run()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        // Get the request URI  
        $requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        // Get and parse the query string
        $queryString = $_SERVER["QUERY_STRING"] ?? "";
        parse_str($queryString, $query);

        // Get request body from POST, PUT and PATCH
        $body = [];
        if (in_array($requestMethod, ["POST", "PUT", "PATCH"])) {
            $contentType = $_SERVER["CONTENT_TYPE"] ?? "";
            if (strpos($contentType, "application/json") !== false) {
                $input = file_get_contents("php://input");
                $body = json_decode($input, true) ?? [];
            } elseif (strpos($contentType, "application/x-www-form-encoded")) {
                $body = $_POST;
            } else {
                header("HTTP/1.0 415 Unsupported Media Type");
                echo json_encode(["error" => "Unsupported Media Type"]);
                return;
            }
        }

        $routeFound = false;
        // By default the method is allowed
        $methodAllowed = true;

        foreach (self::$routes as $route) {
            if ($route["method"] !== $requestMethod) {
                // If all the method are checked and the request method is not found, means that the method is not allowed
                $methodAllowed = false;
                continue;
            }
            $methodAllowed = true;

            $pattner = self::convertRouteToRegex($route["route"]);

            if (preg_match($pattner, $requestUri, $matches)) {
                $routeFound = true;
                $params = self::extractParams($route["route"], $matches);

                # Request object similar to Express.js
                $req = (object) [
                    "params" => $params,
                    "query" => $query,
                    "body" => $body,
                    "method" => $requestMethod,
                    "path" => $requestUri,
                    "headers" => getallheaders(),
                    "cookies" => $_COOKIE,
                ];

                $res = (object) [
                    "status" => function (int $code) {
                        http_response_code($code);
                        return $GLOBALS['res']; # To follow builder pattern
                    },
                    "json" => function ($data) {
                        header("Content-Type: application/json");
                        echo json_encode($data);
                        return $GLOBALS['res']; # To follow builder pattern
                    },
                    "send" => function ($data) {
                        if (is_array($data) || is_object($data)) {
                            header("Content-Type: application/json");
                            echo json_encode($data);
                        } else {
                            echo $data;
                        }
                        return $GLOBALS["res"]; # To follow builder pattern
                    },
                    "setHeader" => function (string $name, string $value) {
                        header($name . ": " . $value);
                        return $GLOBALS["res"]; # To follow builder pattern
                    },
                    "redirect" => function (string $url, int $statusCode = 302) {
                        header("Location: " . $url, true, $statusCode);
                        return $GLOBALS["res"]; # To follow builder pattern
                    },
                    "cookie" => function (string $name, string $value, array $options = []) {
                        $expires = $options['expires'] ?? 0;
                        $path = $options['path'] ?? '/';
                        $domain = $options['domain'] ?? '';
                        $secure = $options['secure'] ?? false;
                        $httpOnly = $options['httpOnly'] ?? false;

                        setcookie($name, $value, $expires, $path, $domain, $secure, $httpOnly);
                        return $GLOBALS["res"]; # To follow builder pattern
                    }
                ];

                $GLOBALS["res"] = $res;

                call_user_func_array($route["callback"], [$req, $res]);
                return;
            }

            // Route not found
            header("HTTP/1.0 404 Not Found");
            echo json_encode(["error" => "404 Not found"]);
        }

        // If the request method is not allowed, return a 405 error
        if (!$methodAllowed) {
            header("HTTP/1.0 405 Method Not Allowed");
            echo json_encode(["error" => "405 Method Not Allowed"]);
            return;
        }

        // If no route was found, return a 404 error
        if (!$routeFound) {
            header("HTTP/1.0 404 Not Found");
            echo json_encode(["error" => "404 Not found"]);
            return;
        }
    }

    private static function extractParams(string $route, array $matches): array
    {
        $params = [];
        $paramNames = [];

        // Extract parameter names from the route
        preg_match_all('/\:([a-zA-Z0-9_]+)/', $route, $paramNames);

        // Remove the full match from $matches
        array_shift($matches);

        // Combine parameter names with their corrisponding values
        foreach ($paramNames[1] as $index => $name) {
            $params[$name] = $matches[$index];
        }

        return $params;
    }

    private static function convertRouteToRegex(string $route)
    {
        // Escape forward slashes for the regex pattern
        // ES: $route = "/users/:userId/books/:bookId";
        $escapedRoute = str_replace("/", "\/", $route);
        // ES: $escapedRoute = "\/users\/:userId\/books\/:bookId";

        // Replace :parameterName with a capturing group
        // ES: $escapedRoute = "\/users\/:userId\/books\/:bookId";
        $pattern = preg_replace('/\:([a-zA-Z0-9_]+)/', '([^\/]+)', $escapedRoute);
        // $pattern = "\/users\/([^\/]+)\/books\/([^\/]+)"

        // Create the complete regex pattern with start and end markers
        return '/^' . $pattern . '$/';
    }
}
