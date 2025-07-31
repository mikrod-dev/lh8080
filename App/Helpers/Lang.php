<?php

namespace Helpers;
require_once(__DIR__ . '/../../config/php/paths.php');
final class Lang
{
    private static array $messages = [];
    private static string $locale = 'es';

    public static function setLocale(string $lang): void
    {
        self::$locale = $lang;

        $file = LANG . "$lang/messages.php";
        if (file_exists($file)) self::$messages = require_once($file);
        else self::$messages = require_once(LANG . "es/messages.php");
    }

    public static function get(string $key, array $replacements = []): string
    {
        $message = self::$messages[$key] ?? $key;

        foreach ($replacements as $placeholder => $value) {
            $message = str_replace(":$placeholder", $value, $message);
        }

        return $message;
    }

}