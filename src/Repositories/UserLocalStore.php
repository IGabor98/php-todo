<?php

namespace Src\Repositories;

use Src\Models\User;
use Src\Repositories\DTO\CreateUserDTO;

class UserLocalStore implements UserRepository
{
    private static $localStore = [];

    public function create(CreateUserDTO $userDTO) : User
    {
        $user = new User(count(self::$localStore), $userDTO->email, $userDTO->password);

        self::$localStore[] = $user;

        return  $user;
    }

    public function get(int $id)
    {
        return self::$localStore[$id + 1];
    }
}