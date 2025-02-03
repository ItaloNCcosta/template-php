<?php

declare(strict_types=1);

namespace App\Controllers;

abstract class AbstractController
{
    public function view(string $view, array $data = []): void
    {
        extract($data);

        // include dirname(__DIR__, 2).'/views/_partials/head.php';
        include("../views/{$view}.php");
        // include dirname(__DIR__, 2).'/views/_partials/footer.php';
    }

    public function redirect(string $routeName = ''): object
    {
        if (empty($routeName)) {
            header("Location:  /", true);
        }

        header("Location:  /{$routeName}", true);
        return $this;
    }

    public function with($key, $message): object
    {
        $_SESSION[$key] = $message;
        return $this;
    }
}
