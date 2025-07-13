<?php

namespace Core;

use PDO;
use PDOException;

final class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO{
        if (self::$connection === null){
            try {
                $host = getenv('DB_HOST');
                $db = getenv('DB_NAME');
                $port = getenv('DB_PORT');
                $user = getenv('DB_USER');
                $password = getenv('DB_PASS');

                if (!$host || !$db || !$user || !$password)
                    throw new PDOException("Database connection failed: missing configuration");

                $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=utf8mb4";
                self::$connection = new PDO($dsn, $user, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                error_log("Database connection failed: " . $e->getMessage());
                die("Database connection error");
            }
        }

        return self::$connection;
    }
}