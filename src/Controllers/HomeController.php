<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\AbstractController;

class HomeController extends AbstractController
{
    public function index(): void
    {
        $this->view('home');
    }
}
