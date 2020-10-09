<?php

namespace Src\Tests\UserService;
use Src\Services\DTO\SignUpDTO;
use Src\Services\User;
use Src\Tests\TestCase;

class UserServiceTest extends TestCase
{
    /** @var User $service */
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->container->get(User::class);
    }

    public function testSignUp()
    {
        $signUpDTO = new SignUpDTO('test@mail.com', 'secret');

        $user = $this->service->signUp($signUpDTO);

        $this->assertEquals($signUpDTO->email, $user->getEmail());
    }
}