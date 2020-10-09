<?php

namespace Src\Repositories;

use Src\Models\User;
use Src\Repositories\DTO\CreateUserDTO;

interface UserRepository
{
    public function create(CreateUserDTO $userDTO) : User;
    public function get(int $id);
}