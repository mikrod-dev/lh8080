<?php

namespace Helpers;

require_once(__DIR__ . '/../../config/php/paths.php');

final class Config
{
    private static array $config;

    private static function load(string $file): void
    {
        if (!isset(self::$config[$file])) {
            $path = CONFIG . $file . '.php';

            if(!file_exists($path)){
                error_log("[CONFIG] load(): Archivo de configuración faltante: $path");
                self::$config[$file] = [];
                return;
            }

            self::$config[$file] = require_once($path);
        }
    }


    public static function get(string $key, mixed $default = null): mixed
    {
        [ $file, $fileKey ] = explode('.', $key, 2);
        self::load($file);

        if(!array_key_exists($fileKey, self::$config[$file])){
            error_log("[CONFIG] get(): Clave $fileKey no definida en $file");
            return $default;
        }

        return self::$config[$file][$fileKey];
    }

}