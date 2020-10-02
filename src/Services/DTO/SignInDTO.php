<?php

namespace Src\Services\DTO;

class SignInDTO
{
    public $email;
    public $password;

   public function __construct(string $email, string $password)
   {
       $this->email = $email;
       $this->password = $password;
   }
}