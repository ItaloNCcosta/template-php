<?php

declare(strict_types=1);

namespace App\Helpers;

class Helper
{
    public static function castingParams(array &$params): void
    {
        foreach ($params as $key => $param) {
            if (is_numeric($param)) {
                if(!is_int($param)) {
                    $params[$key] = (float) $param;
                }
                $params[$key] = (int) $param;
            }
        }
    }

    public static function match(string $subject, string $path): array|bool
    {
        if($subject === '/' . $path) {
            return [];
        }

        // Expressão regular para validar o endereço levando em consideração o padrão que utilizamos para associar parametros na uri: {parametro}
        $pattern = "/" . preg_replace('/\{[^\}]+\}/', '([^/]+)', $path);

        // Validação de endereço de acordo com padrão definido logo acima.
        preg_match('#^' . $pattern . '$#', $subject, $matches);

        array_shift($matches);

        if(empty($matches)) {
            return false;
        }

        return $matches;
    }
}
