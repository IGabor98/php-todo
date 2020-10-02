<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Relay\Relay;
use Src\Http\Controllers\UserController;
use Src\Services\User;
use Src\Services\UserService;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response;
use Narrowspark\HttpEmitter\SapiEmitter;

use function DI\create;
use function DI\get;
use function FastRoute\simpleDispatcher;


require_once dirname(__DIR__) . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
//$containerBuilder->useAutowiring(false);
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions([
    UserController::class => create(UserController::class)->constructor( get("Response"), get(User::class)),
    User::class => create(UserService::class),
    'Response' => create(Response::class)
]);

$container = $containerBuilder->build();

$routes = simpleDispatcher(function (RouteCollector $r) {
    $r->post('/sign-up', [UserController::class, 'signUp']);
});

$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($container);

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();

return $emitter->emit($response);