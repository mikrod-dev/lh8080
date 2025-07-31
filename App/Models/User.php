<?php

namespace Models;

require_once(__DIR__ . '/../../bootstrap/autoload.php');;

use Repositories\UserRepository;

class User
{
    private int $id;
    private string $name;
    private string $username;
    private string $email;
    private string $passwordHash;
    private string $role;
    private ?string $avatarUrl;
    private bool $isActive;
    private string $createdAt;
    private string $updatedAt;
    private ?string $lastLogin;
    private string $preferred_language;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->name = $data['name'] ?? '';
        $this->username = $data['username'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->passwordHash = $data['password_hash'] ?? '';
        $this->role = $data['role'] ?? 'user';
        $this->isActive = $data['is_active'] ?? true;
        $this->createdAt = $data['created_at'] ?? date('Y-m-d H:i:s');
        $this->updatedAt = $data['updated_at'] ?? $this->createdAt;
        $this->lastLogin = $data['last_login'] ?? null;
        $this->preferred_language = $data['preferred_language'] ?? 'es';
        $this->setAvatarUrl($data['avatar_url'] ?? null);
    }

    // Setters

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setLastLogin(): void
    {
        $userRepository = new UserRepository();
        $userRepository->setLastLogin($this->getId());
    }

    public function touchNow(): void
    {
        $this->updatedAt = date('Y-m-d H:i:s');
    }

    public function setAvatarUrl(?string $url = null): void
    {
        $this->avatarUrl = $url ?? "https://api.dicebear.com/9.x/bottts-neutral/svg?seed=" . urlencode($this->username);
    }

    public function setPreferredLanguage(string $lang): void
    {
        $this->preferred_language = $lang;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    // Getters
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

    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
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

    public function getLastLogin(): ?string
    {
        return $this->lastLogin;
    }

    public function getPreferredLanguage(): string
    {
        return $this->preferred_language;
    }

    public function getRole(): string
    {
        return $this->role;
    }


}