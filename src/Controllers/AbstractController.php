<?php

declare(strict_types=1);

namespace App\Controllers;

abstract class AbstractController
{
    public function view(string $view, array $data = []): void
    {
        extract($data);

        ob_start();
        include dirname(__DIR__, 2) . "/views/{$view}.php";
        $content = ob_get_clean();

        include dirname(__DIR__, 2) . "/views/layouts/main.php";
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
