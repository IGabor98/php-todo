<?php

namespace Src\Services;

use Src\Repositories\DTO\CreateUserDTO;
use Src\Repositories\UserRepository;
use Src\Services\DTO\SignInDTO;
use Src\Services\DTO\SignUpDTO;

class UserService implements User
{
    /** @var UserRepository $repository */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function signUp(SignUpDTO $signUpDTO) : \Src\Models\User
    {
        $createUserDTO = new CreateUserDTO($signUpDTO->email, $signUpDTO->password);

        return $this->repository->create($createUserDTO);
    }

    public function signIn(SignInDTO $signInDTO)
    {

    }
}