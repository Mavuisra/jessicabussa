<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected function view(string $template, array $data = [], ?string $layout = 'base'): never
    {
        echo View::render($template, $data, $layout);
        exit;
    }

    protected function adminView(string $template, array $data = []): never
    {
        $this->view($template, $data, 'admin');
    }

    protected function json(array $data, int $status = 200): never
    {
        json_response($data, $status);
    }

    protected function redirectRoute(string $name, mixed ...$params): never
    {
        redirect(url($name, ...$params));
    }

    protected function validateCsrf(): void
    {
        Csrf::verifyRequest();
    }

    protected function flashSuccess(string $message): void
    {
        Session::flash('success', $message);
    }

    protected function flashError(string $message): void
    {
        Session::flash('error', $message);
    }
}
