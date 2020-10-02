<?php

namespace Src\Services;

use Src\Services\DTO\SignInDTO;
use Src\Services\DTO\SignUpDTO;

class UserService implements User
{
    public function signUp(SignUpDTO $signUpDTO)
    {
        return "Email: $signUpDTO->email\nPassword: $signUpDTO->password";
    }

    public function signIn(SignInDTO $signInDTO)
    {

    }
}