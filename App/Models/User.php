<?php

namespace Models;

require_once(__DIR__ . '/../../config/php/paths.php');
require_once(CORE . 'Database.php');

use Core\Database;

class User
{
    private int $id;
    private string $name;
    private string $username;
    private string $email;
    private string $passwordHash;
    private ?string $avatarUrl;
    private bool $isActive;
    private ?string $createdAt;
    private ?string $updatedAt;
    private ?string $lastLogin;


    public static function create(array $data): self
    {
        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->passwordHash = $data['password'];
        $user->setAvatarUrl($data['avatar'] ?? null);;
        $user->isActive = true;
        $user->createdAt = date('Y-m-d H:i:s');
        $user->touchNow();
        return $user;
    }

    public static function existsByUsername(string $username): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT 1 FROM users WHERE username = :username LIMIT 1');
        $stmt->execute([':username' => $username]);
        return $stmt->fetchColumn() > 0;
    }

    public static function existsByEmail(string $email): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT 1 FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    public static function findByUsername(string $username): ?self
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
        $stmt->execute([':username' => $username]);
        $data = $stmt->fetch();

        if ($data === false) {
            return null;
        }

        $user = new self();
        $user->id = (int)$data['user_id'];
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->passwordHash = $data['password_hash'];
        $user->avatarUrl = $data['avatar_url'];
        $user->isActive = (bool)$data['is_active'];
        $user->createdAt = $data['created_at'];
        $user->updatedAt = $data['updated_at'];
        $user->lastLogin = $data['last_login'];

        return $user;
    }

    public function save(): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            'INSERT INTO users (
                   name, 
                   username, 
                   email, 
                   password_hash,
                   avatar_url,
                   is_active, 
                   created_at, 
                   updated_at) 
                    VALUES (
                            :name, 
                            :username,
                            :email, 
                            :password_hash, 
                            :avatar_url,
                            :is_active, 
                            :created_at, 
                            :updated_at)');

        return $stmt->execute([
            ':name' => $this->name,
            ':username' => $this->username,
            ':email' => $this->email,
            ':password_hash' => $this->passwordHash,
            ':avatar_url' => $this->avatarUrl,
            ':is_active' => $this->isActive,
            ':created_at' => $this->createdAt,
            ':updated_at' => $this->updatedAt
        ]);
    }

    public function setLastLogin(): void
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('UPDATE users SET last_login = NOW() WHERE user_id = :user_id');
        $stmt->execute([':user_id' => $this->getId()]);
    }

    public function touchNow(): void
    {
        $this->updatedAt = date('Y-m-d H:i:s');
    }

    public function setAvatarUrl(?string $url = null): void
    {
        $this->avatarUrl = $url ??  "https://api.dicebear.com/9.x/bottts-neutral/svg?seed=" . urlencode($this->username);
    }

    public function getAvatarUrl(): string
    {
        return $this->avatarUrl ?? '';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getLastLogin(): string
    {
        return $this->lastLogin;
    }

}