<?php

namespace Src\Repositories;

use Src\Repository\DTO\CreateUserDTO;

interface UserRepository
{
    public function create(CreateUserDTO $userDTO);
    public function get(int $id);
}