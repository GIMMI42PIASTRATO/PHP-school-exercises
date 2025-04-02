<?php

declare(strict_types=1);

class Request
{
    public array $params;
    public array $query;
    public mixed $body;
    public string $method;
    public string $path;
    public false | array $headers;
    public array $cookie;

    public function __construct(
        array $params = [],
        array $query = [],
        mixed $body = [],
        string $method = "",
        string $path = "",
        false | array $headers = [],
        array $cookie = []
    ) {
        $this->params = $params;
        $this->query = $query;
        $this->body = $body;
        $this->method = $method;
        $this->path = $path;
        $this->headers = $headers;
        $this->cookie = $cookie;
    }
}
