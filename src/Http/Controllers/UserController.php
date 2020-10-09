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

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
     */
    public function signUp(ServerRequestInterface $request)
    {
        $body = $request->getBody();
        $params = json_decode($body, true);
        $body->close();
        $response = $this->response->withHeader('Content-Type', 'application/json');
        if(!(isset($params['email']) && isset($params['password']))) {
            return $response->withStatus(422, 'email and password are required fields');
        }

        $signUpDTO = new SignUpDTO($params['email'], $params['password']);

        $user = $this->service->signUp($signUpDTO);

        $data = [
        	'email' => $user->getEmail(),
			'password' => $user->getPassword(),
		];

        $response->getBody()->write(json_encode($data));

        return $response;
    }

    public function signIn()
    {

    }
}