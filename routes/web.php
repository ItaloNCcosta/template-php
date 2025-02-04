<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Enums\HttpMethodEnum;

return [
    ['',  [HomeController::class, 'index'], HttpMethodEnum::GET]
];