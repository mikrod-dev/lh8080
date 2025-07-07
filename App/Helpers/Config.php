<?php

namespace Helpers;

require_once(__DIR__ . '/../../config/php/paths.php');

final class Config
{
    private static array $config = [];

    private static function load(string $file): array
    {
        if (!isset(self::$config[$file])) {
            $path = CONFIG . $file . '.php';
            self::$config[$file] = file_exists($path) ? require_once($path) : [];
        }

        return self::$config[$file];
    }

    public static function get(string $key, string $default = null): mixed
    {
        [ $file, $fileKey ] = explode('.', $key, 2);
        self::load($file);
        return self::$config[$file][$fileKey] ?? $default;
    }

    public static function getAll(string $file = 'general'): array
    {
        return self::load($file);
    }

}