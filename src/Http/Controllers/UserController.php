<?php

namespace Src\Http\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Services\DTO\SignUpDTO;
use Src\Services\User;

class UserController
{
    /** @var ResponseInterface $response */
    private $response;
    /** @var User $service */
    private $service;

    public function __construct(ResponseInterface $response, User $service)
    {
        $this->response = $response;
        $this->service = $service;
    }

    public function signUp(ServerRequestInterface $request)
    {
        $body = $request->getBody();
        $params = json_decode($body, true);
        $body->close();

        $signUpDTO = new SignUpDTO($params['email'], $params['password']);
        $user = $this->service->signUp($signUpDTO);
        $response = $this->response->withHeader('Content-Type', 'application/json');
        $response->getBody()
            ->write($user);

        return $response;
    }

    public function signIn()
    {

    }
}