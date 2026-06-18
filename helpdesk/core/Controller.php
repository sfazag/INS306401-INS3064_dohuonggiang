<?php

class Controller
{
    protected function view(
        string $view,
        array $data = []
    ): void
    {
        extract($data);

        require_once "views/{$view}.php";
    }

    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }

    protected function json(
        array $data,
        int $status = 200
    ): void
    {
        http_response_code($status);

        header('Content-Type: application/json');

        echo json_encode($data);

        exit;
    }

    protected function requireAuth(): void
    {
        if(!isset($_SESSION['user']))
        {
            die("Please login first");
        }
    }

    protected function requireRole(array $roles): void
    {
        $this->requireAuth();

        if(
            !in_array(
                $_SESSION['user']['role'],
                $roles
            )
        )
        {
            die("Access denied");
        }
    }
}