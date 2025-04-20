<?php

declare(strict_types=1);

class Response
{
    public function status(int $code): Response
    {
        http_response_code($code);
        return $this; # To follow builder pattern
    }

    public function json($data): Response
    {
        header("Content-Type: application/json");
        echo json_encode($data);
        return $this; # To follow builder pattern
    }

    public function send($data): Response
    {
        if (is_array($data) || is_object($data)) {
            header("Content-Type: application/json");
            echo json_encode($data);
        } else {
            echo $data;
        }
        return $this; # To follow builder pattern
    }

    public function setHeader(string $name, string $value): Response
    {
        header($name . ": " . $value);
        return $this; # To follow builder pattern
    }

    public function redirect(string $url, int $statusCode = 302): Response
    {
        header("Location: " . $url, true, $statusCode);
        return $this; # To follow builder pattern
    }

    public function cookie(string $name, string $value, array $options = []): Response
    {
        $expires = $options['expires'] ?? 0;
        $path = $options['path'] ?? '/';
        $domain = $options['domain'] ?? '';
        $secure = $options['secure'] ?? false;
        $httpOnly = $options['httpOnly'] ?? false;

        setcookie($name, $value, $expires, $path, $domain, $secure, $httpOnly);
        return $this; # To follow builder pattern
    }
}
