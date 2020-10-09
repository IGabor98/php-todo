<?php
namespace Src;

use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use Src\Http\Controllers\UserController;
use Src\Services\User;
use Src\Services\UserService;
use Zend\Diactoros\Response;

use function DI\create;
use function DI\get;
use function FastRoute\simpleDispatcher;
use Src\Repositories\UserRepository;

class App
{
	public static function getContainer()
	{
		$containerBuilder = new ContainerBuilder();
		$containerBuilder->useAutowiring(false);
		$containerBuilder->useAnnotations(false);
		$containerBuilder->addDefinitions(
			[
				UserController::class => create(UserController::class)->constructor(get("Response"), get(User::class)),
				User::class => create(UserService::class)->constructor(get(UserRepository::class)),
				'Response' => create(Response::class),

				UserRepository::class => create(\Src\Repositories\UserLocalStore::class )
			]
		);

		return $containerBuilder->build();
	}

	public static function getRoutes()
	{
		$routes = simpleDispatcher(
			function(RouteCollector $r) {
				$r->post('/sign-up', [UserController::class, 'signUp']);
			}
		);

		return $routes;
	}
}