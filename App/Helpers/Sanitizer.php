<?php

namespace Helpers;

final class Sanitizer
{
    // Sanitizar texto plano
    // verificar si se puede reducir con htmlspecialchars() + strip_tags()
    // problema: FILTER_SANITIZE_STRING está obsoleto. el manual recomienda usar htmlspecialchars()
    public static function text(string $text, ?int $max_length = null): string
    {
        $sanitized = trim($text);
        $sanitized = htmlspecialchars(strip_tags($sanitized), ENT_QUOTES, 'UTF-8');
        //utf-8mb4 es solo para mysql para solucionar el problema de codificación de 3 bytes

        if ($max_length && mb_strlen($sanitized) > $max_length) {
            $sanitized = mb_substr($sanitized, 0, $max_length);
        }

        return $sanitized;
    }

    public static function email(string $email): string
    {
        return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    }

    public static function url(string $url): string
    {
        return filter_var(trim($url), FILTER_SANITIZE_URL);
    }

    public static function int(string $number): string{
        return filter_var(trim($number), FILTER_SANITIZE_NUMBER_INT);
    }

    // Obtiene el parámetro de la URL con $_GET y lo sanitiza según el tipo especificado o valor por defecto
    public static function urlParams(string $param, $default = '', string $type = 'string'): string
    {
        $value = $_GET[$param] ?? $default;

        return match ($type) {
            'int' => max(1, intval($value)),
            'slug' => preg_replace('/[^a-zA-Z0-9\-_]/', '', $value),
            default => self::text((string)$value),
        };
    }

    // Sanitizar HTML permitiendo solo tags seguros
    public static function html(string $html, string $allowed_tags = '<p><br><strong><em><ul><ol><li><h1><h2><h3><a><img>'): string
    {
        $sanitized = trim($html);
        $sanitized = strip_tags($sanitized, $allowed_tags);
        $sanitized = preg_replace('/(<[^>]*)\s+(on\w+|javascript:|vbscript:|data:)[^>]*>/i', '$1>', $sanitized);

        return $sanitized;
    }

    // Slug para URLs amigables
    public static function slug(string $slug): string
    {
        $sanitized_slug = iconv('UTF-8', 'ASCII//TRANSLIT', strtolower($slug));
        $sanitized_slug = preg_replace('/[^a-zA-Z0-9\/_|+ -]/', '', $sanitized_slug);
        $sanitized_slug = preg_replace('/[\/_|+ -]+/', '-', $sanitized_slug);

        return trim($sanitized_slug, '-');

    }

    // Para prevenir XSS
    public static function output(string $output): string
    {
        return htmlspecialchars($output, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    public static function filename(string $filename): string
    {
        return preg_replace('/[^a-zA-Z0-9.]/', '', basename($filename));
    }

    // Limpieza de array recursivamente
    public static function cleanArray(array $array): array
    {
        $clean_array = [];

        foreach ($array as $key => $value) {
            $key = self::text((string)$key);
            $clean_array[$key] = is_array($value) ? self::cleanArray($value) : self::text((string)$value);
        }

        return $clean_array;
    }

}