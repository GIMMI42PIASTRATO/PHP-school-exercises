<?php

declare(strict_types=1);

abstract class Controller
{
    protected function render(Response $res, string $view, array $data = []): void
    {
        $res->view($view, $data);
    }

    protected function json(Response $res, $data, int $statusCode = 200): void
    {
        $res->status($statusCode)->json($data);
    }

    protected function redirect(Response $res, string $url, int $statusCode = 302): void
    {
        $res->redirect($url, $statusCode);
    }
}
