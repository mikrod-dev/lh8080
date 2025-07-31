<?php

namespace Helpers;

use Exception;

require_once(__DIR__ . '/../../config/php/paths.php');

final class Config
{
    private static array $config;

    /**
     * @throws Exception
     */
    private static function load(string $file): void
    {
        if (!isset(self::$config[$file])) {
            $path = CONFIG . $file . '.php';

            if(!file_exists($path)){
                throw new Exception("Archivo de configuración faltante: $path");
            }

            self::$config[$file] = require_once($path);
        }
    }

    /**
     * @throws Exception
     */
    public static function get(string $key): mixed
    {
        [ $file, $fileKey ] = explode('.', $key, 2);
        self::load($file);

        if(!array_key_exists($fileKey, self::$config[$file])){
            throw new Exception("Clave $fileKey no definida en $file");
        }

        return self::$config[$file][$fileKey];
    }

}