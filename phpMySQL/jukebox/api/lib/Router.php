<?php

declare(strict_types=1);

require __DIR__ . "/Request.php";
require __DIR__ . "/Response.php";

class Router
{
    // Where routes are stored at runtime
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
        // $requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $fullUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER["SCRIPT_NAME"])), '/');

        // Rimuove la directory base dal percorso
        if (str_starts_with($fullUri, $scriptDir)) {
            $requestUri = '/' . ltrim(substr($fullUri, strlen($scriptDir)), '/');
        } else {
            $requestUri = $fullUri; // fallback
        }

        # Debug
        // echo "SCRIPT_NAME: " . $_SERVER["SCRIPT_NAME"] . PHP_EOL;
        // echo "dirname(SCRIPT_NAME): " . dirname($_SERVER["SCRIPT_NAME"]) . PHP_EOL;
        // echo "REQUEST_URI: " . $_SERVER["REQUEST_URI"] . PHP_EOL;
        // echo "URI dopo il parse: " . $fullUri . PHP_EOL;
        # End Debug


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
            } elseif (strpos($contentType, "application/x-www-form-encoded") !== false) {
                $body = $_POST;
            } else {
                header("HTTP/1.0 415 Unsupported Media Type");
                echo json_encode(["error" => "Unsupported Media Type"]);
                return;
            }
        }

        $routeFound = false;
        $methodMatched = false;

        foreach (self::$routes as $route) {
            $pattner = self::convertRouteToRegex($route["route"]);

            if (preg_match($pattner, $requestUri, $matches)) {
                // If here the route exists
                $routeFound = true;

                if ($route["method"] === $requestMethod) {
                    $methodMatched = true;
                    $params = self::extractParams($route["route"], $matches);

                    # Request object similar to Express.js
                    $req = new Request(
                        $params,
                        $query,
                        $body,
                        $requestMethod,
                        $requestUri,
                        getallheaders(),
                        $_COOKIE,
                    );

                    # Response object similar to Express.js
                    $res = new Response();

                    // To be albe to call class methods
                    if (is_array($route["callback"])) {
                        [$controller, $method] = $route["callback"];
                        if (class_exists($controller) && method_exists($controller, $method)) {
                            call_user_func_array([$controller, $method], [$req, $res]);
                            return;
                        }
                    }

                    // To be able to call just normal functions
                    call_user_func_array($route["callback"], [$req, $res]);
                    return;
                }
            }
        }

        // If the route exists but the method is not supported
        if ($routeFound && !$methodMatched) {
            header("HTTP/1.0 405 Method Not Allowed");
            echo json_encode(["error" => "405 Method Not Allowed"]);
            return;
        }

        // If any route was found
        header("HTTP/1.0 404 Not Found");
        echo json_encode(["error" => "404 Not Found"]);
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
