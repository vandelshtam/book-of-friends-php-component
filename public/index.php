<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

if( !session_id() ) @session_start();

require '../vendor/autoload.php';

use Aura\SqlQuery\QueryFactory;
use Delight\Auth\Auth;
use DI\ContainerBuilder;
use League\Plates\Engine;
use \Tamtamchik\SimpleFlash\Flash; 


$containerBuilder = new \DI\ContainerBuilder();

$containerBuilder->addDefinitions([
    Engine::class => function(){
    return new Engine('../app/views');
},
    QueryFactory::class => function(){
    return new QueryFactory('mysql');
},
    PDO::class => function(){
    $driver = 'mysql';
    $host = 'localhost:8889';
    $database_name = 'app3';
    $username = 'root';
    $password = 'root';
    return new PDO("$driver:host=$host; dbname=$database_name; charset=utf8;",$username,$password);
},
    Auth::class => function($container){
    return new Auth($container->get('PDO', 'null', 'null', 'false'));
}
]);

$container = $containerBuilder->build();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/home', ['App\controllers\HomeController','home']);
    $r->addRoute('GET', '/page_profile/{id:\d+}', ['App\controllers\HomeController','page_profile']);
    $r->addRoute('GET', '/index.php/edit_user/{id:\d+}', ['App\controllers\UserController','edit']);
    $r->addRoute('POST', '/index.php/edit_user/{id:\d+}', ['App\controllers\UserController','edit']);
    $r->addRoute('GET', '/public/index.php/register', ['App\controllers\UserController','register']);
    $r->addRoute('POST', '/public/index.php/register', ['App\controllers\UserController','register']);
    $r->addRoute('GET', '/public/index.php/verification', ['App\controllers\UserController','email_verification']);
    $r->addRoute('POST', '/public/index.php/verification', ['App\controllers\UserController','email_verification']);
    $r->addRoute('GET', '/public/index.php/login', ['App\controllers\UserController','login']);
    $r->addRoute('POST', '/public/index.php/login', ['App\controllers\UserController','login']);
    $r->addRoute('GET', '/public/index.php/logout', ['App\controllers\UserController','logout']);
    $r->addRoute('GET', '/public/index.php/status/{id:\d+}', ['App\controllers\HomeController','status']);
    $r->addRoute('POST', '/public/index.php/status/{id:\d+}', ['App\controllers\HomeController','status']);
    $r->addRoute('GET', '/public/index.php/load_avatar/{id:\d+}', ['App\controllers\HomeController','avatar']);
    $r->addRoute('POST', '/public/index.php/load_avatar/{id:\d+}', ['App\controllers\HomeController','avatar']);
    $r->addRoute('GET', '/public/index.php/addUser', ['App\controllers\UserController','addUser']);
    $r->addRoute('POST', '/public/index.php/addUser', ['App\controllers\UserController','addUser']);
    $r->addRoute('GET', '/about', ['App\controllers\HomeController','about']);
    $r->addRoute('GET', '/public/index.php/roles/{id:\d+}', ['App\controllers\UserController','roles']);
    $r->addRoute('POST', '/public/index.php/roles/{id:\d+}', ['App\controllers\UserController','roles']);
    $r->addRoute('GET', '/public/index.php/delete/{id:\d+}', ['App\controllers\UserController','delete']);
    $r->addRoute('POST', '/public/index.php/delete/{id:\d+}', ['App\controllers\UserController','delete']);
    $r->addRoute('GET', '/public/index.php/security_admin/{id:\d+}', ['App\controllers\UserController','security_admin']);
    $r->addRoute('POST', '/public/index.php/security_admin/{id:\d+}', ['App\controllers\UserController','security_admin']);
    $r->addRoute('GET', '/public/index.php/paginator', ['App\controllers\HomeController','paginator']);
    $r->addRoute('GET', '/public/index.php/confirm_password/{id:\d+}', ['App\controllers\UserController','confirm_password']);
    $r->addRoute('POST', '/public/index.php/confirm_password/{id:\d+}', ['App\controllers\UserController','confirm_password']);
    
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $container->call($handler,[$vars]);
        break;
}








