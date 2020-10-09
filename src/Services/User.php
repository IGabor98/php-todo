<?php

namespace Src\Services;

use Src\Services\DTO\SignInDTO;
use Src\Services\DTO\SignUpDTO;

interface User
{
    public function signUp(SignUpDTO $signUpDTO) : \Src\Models\User;
    public function signIn(SignInDTO $signInDTO);
}