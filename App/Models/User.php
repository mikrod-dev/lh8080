<?php

namespace Models;

class User
{
    private int $id;
    private string $name;
    private string $username;
    private string $email;
    private string $passwordHash;
    private bool $isActive;
    private ?string $createdAt;
    private ?string $updatedAt;
    private ?string $lastLogin;


    public static function create(array $data): self{
        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->passwordHash = $data['password'];
        $user->isActive = true;
        $user->createdAt = date('Y-m-d H:i:s');//modularizar
//        $user->updatedAt = $data['updatedAt'];
//        $user->lastLogin = $data['lastLogin'];
        return $user;
    }

    public static function findByUsername(string $username): User
    {
        return new User();//para hacer
    }

    public static function findById(int $id): User
    {
        return new User();//para hacer si hace falta
    }

    public function toArray(): array
    {
        return [
          'username' => $this->getUsername(),
          'email' => $this->getEmail(),
          'isActive' => $this->getIsActive(),
        ];
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;//revisar si tiene uso
    }

    public function getEmail(){
        return $this->email;//revisar si tiene uso
    }

    public function getPasswordHash(){
        return $this->passwordHash;
    }

    public function getIsActive(){
        return $this->isActive;
    }

    public function getUsername()
    {
        return $this->username;
    }




}