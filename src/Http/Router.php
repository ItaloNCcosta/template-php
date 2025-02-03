<?php

declare(strict_types=1);

namespace App\Http;

use App\Enums\HttpMethodEnum;
use App\Helpers\Helper;
use ReflectionMethod;
use App\Http\Request;
use Exception;

class Router
{
    private const PATH = 0;
    private const ACTION = 1;
    private const HTTP_METHOD = 2;
    private const CONTROLLER_NAME = 0;
    private const NAME = 1;

    public static function run(array $routes): void
    {
        ob_start();

        try {
            foreach ($routes as $route) {
                if (!self::isMatchingRequest($route[self::HTTP_METHOD])) {
                    continue;
                }

                $controller = self::instantiateController($route[self::ACTION][self::CONTROLLER_NAME]);
                file_put_contents('log.txt', 'Controlador instanciado: ' . get_class($controller) . PHP_EOL, FILE_APPEND);

                if (!$controller) {
                    continue;
                }

                $methodName = $route[self::ACTION][self::NAME];

                if (!method_exists($controller, $methodName)) {
                    continue;
                }

                $params = self::resolveParameters($route);

                if ($params === false) {
                    continue;
                }

                $controller->{$methodName}(...$params);

                ob_end_flush();
                return;
            }

            throw new Exception('Not found router or controller or method', 404);
        } catch (Exception $e) {
            http_response_code($e->getCode() === 404 ? 404 : 500);
            echo "Erro: " . $e->getMessage();
            file_put_contents('log.txt', 'Erro capturado: ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
            ob_end_flush();
        }
    }

    private static function isMatchingRequest(HttpMethodEnum $routeMethod): bool
    {
        return Request::getHttpMethod() === $routeMethod;
    }

    private static function instantiateController(string $controller): ?object
    {
        if (!class_exists($controller)) {
            throw new \Exception("O controlador '{$controller}' não foi encontrado.");
        }

        return new $controller(new Request());
    }

    private static function resolveParameters(array $route): array|bool
    {
        $methodName = $route[self::ACTION][self::NAME];
        $controllerName = $route[self::ACTION][self::CONTROLLER_NAME];

        $expectedParamsCount = (new ReflectionMethod($controllerName, $methodName))->getNumberOfParameters();

        $params = Helper::match(Request::getUri(), $route[self::PATH]);

        if ($expectedParamsCount > 0 && !empty($params) && $params != false) {
            Helper::castingParams($params);
        }

        return $params;
    }
}
