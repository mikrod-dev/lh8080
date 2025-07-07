<?php

declare(strict_types=1);

namespace Helpers;

final class Validator
{
    public static function required(string $value): bool
    {
        return trim($value) !== '';
    }

    public static function email(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function url(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    public static function int(string $number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false;
    }

    public static function stringLength(string $string, int $min = 1, ?int $max = null): bool
    {
        $length = mb_strlen($string);
        if ($length < $min) return false;
        if ($max !== null && $length > $max) return false;
        return true;
    }

    public static function match(string $a, string $b): bool
    {
        return $a === $b;
    }

}