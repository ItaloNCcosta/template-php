<?php

declare(strict_types=1);

namespace App\Http;

use App\Enums\HttpMethodEnum;
use App\Http\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    public static function getUri(): string
    {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }

    public static function getHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::fromValue($_SERVER['REQUEST_METHOD']);
    }

    public static function getQueryParams(): array
    {
        return $_GET;
    }

    public static function getBody(): array|false
    {
        $body = file_get_contents('php://input');

        if (!empty($body)) {
            parse_str($body, $data);
            return $data;
        }

        return false;
    }

    public static function getBaseUrl(): string
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

        return $protocol . '://' . $_SERVER['HTTP_HOST'];
    }
}
