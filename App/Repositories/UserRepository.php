<?php
declare(strict_types=1);

namespace Repositories;
require_once(__DIR__ . '/../../bootstrap/autoload.php');

use Controllers\AuthController;
use Core\Database;
use Core\ErrorHandler;
use Models\User;
use PDOException;

class UserRepository
{
    public function existsByUsername(string $username): bool
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare('SELECT 1 FROM users WHERE username = :username LIMIT 1');
            $stmt->execute([':username' => $username]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("[USER_REPOSITORY] existsByUsername(): " . $e->getMessage());
            return false;
        }
    }

    public function existsByEmail(string $email): bool
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare('SELECT 1 FROM users WHERE email = :email LIMIT 1');
            $stmt->execute([':email' => $email]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("[USER_REPOSITORY] existsByEmail(): " . $e->getMessage());
            return false;
        }
    }

    public function findByUsername(string $username): User|null
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
            $stmt->execute([':username' => $username]);
            $data = $stmt->fetch();

            if ($data === false) {
                return null;
            }

            return new User(
                [
                    'id' => (int)$data['user_id'],
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password_hash' => $data['password_hash'],
                    'role' => $data['role'],
                    'avatar_url' => $data['avatar_url'],
                    'is_active' => (bool)$data['is_active'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at'],
                    'last_login' => $data['last_login'],
                    'preferred_language' => $data['preferred_language']
                ]
            );
        } catch (PDOException $e) {
            error_log("[USER_REPOSITORY] findByUsername(): " . $e->getMessage());
            ErrorHandler::connectionError();//503
        }
    }

    public function save(User $user): bool
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare(
                'INSERT INTO users (
                   name, 
                   username, 
                   email, 
                   password_hash,
                   role,
                   avatar_url,
                   is_active, 
                   created_at, 
                   updated_at) 
                    VALUES (
                            :name, 
                            :username,
                            :email, 
                            :password_hash,
                            :role,
                            :avatar_url,
                            :is_active, 
                            :created_at, 
                            :updated_at)');

            $success = $stmt->execute([
                ':name' => $user->getName(),
                ':username' => $user->getUsername(),
                ':email' => $user->getEmail(),
                ':password_hash' => $user->getPasswordHash(),
                ':role' => $user->getRole(),
                ':avatar_url' => $user->getAvatarUrl(),
                ':is_active' => $user->getIsActive(),
                ':created_at' => $user->getCreatedAt(),
                ':updated_at' => $user->getUpdatedAt()
            ]);

            // Autologin post signup
            if ($success) {
                $user->setId((int)$db->lastInsertId());
                $authController = new AuthController();
                $authController->loadUser($user);
            }

            return $success;
        } catch (PDOException $e) {
            error_log("[USER_REPOSITORY] save(): " . $e->getMessage());
            if ($e->getCode() === '2006') {
                // MySQL server has gone away
                ErrorHandler::connectionError();//503
            } else {
                ErrorHandler::serverError();//500
            }
        }
    }

    public function setLastLogin(int $id): void
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare('UPDATE users SET last_login = NOW() WHERE user_id = :id');
            $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("[USER_REPOSITORY] setLastLogin(): " . $e->getMessage());
        }
    }

    public function updateLanguage(int $id, string $lang): void
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare('UPDATE users SET preferred_language = :lang WHERE user_id = :id');
            $stmt->execute([':id' => $id, ':lang' => $lang]);
        } catch (PDOException $e) {
            error_log("[USER_REPOSITORY] updateLanguage(): " . $e->getMessage());
        }
    }

    public function updateAvatarUrl(int $id, string $avatar_url): void
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare('UPDATE users SET avatar_url = :avatar_url WHERE user_id = :id');
            $stmt->execute([':id' => $id, ':avatar_url' => $avatar_url]);
        } catch (PDOException $e) {
            error_log("[USER_REPOSITORY] updateAvatarUrl(): " . $e->getMessage());
        }
    }
}