<?php

namespace Src\Services;

use Src\Services\DTO\SignInDTO;
use Src\Services\DTO\SignUpDTO;

interface User
{
    public function signUp(SignUpDTO $signUpDTO);
    public function signIn(SignInDTO $signInDTO);
}