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
    $r->addRoute('GET', '/book-of-friends-php-component/home', ['App\controllers\HomeController','home']);
    $r->addRoute('GET', '/book-of-friends-php-component/page_profile/{id:\d+}', ['App\controllers\HomeController','page_profile']);
    $r->addRoute('GET', '/book-of-friends-php-component/edit_user/{id:\d+}', ['App\controllers\UserController','edit']);
    $r->addRoute('POST', '/book-of-friends-php-component/edit_user/{id:\d+}', ['App\controllers\UserController','edit']);
    $r->addRoute('GET', '/book-of-friends-php-component/register', ['App\controllers\UserController','register']);
    $r->addRoute('POST', '/book-of-friends-php-component/register', ['App\controllers\UserController','register']);
    $r->addRoute('GET', '/book-of-friends-php-component/verification', ['App\controllers\UserController','email_verification']);
    $r->addRoute('POST', '/book-of-friends-php-component/verification', ['App\controllers\UserController','email_verification']);
    $r->addRoute('GET', '/book-of-friends-php-component/login', ['App\controllers\UserController','login']);
    $r->addRoute('POST', '/book-of-friends-php-component/login', ['App\controllers\UserController','login']);
    $r->addRoute('GET', '/book-of-friends-php-component/logout', ['App\controllers\UserController','logout']);
    $r->addRoute('GET', '/book-of-friends-php-component/status/{id:\d+}', ['App\controllers\HomeController','status']);
    $r->addRoute('POST', '/book-of-friends-php-component/status/{id:\d+}', ['App\controllers\HomeController','status']);
    $r->addRoute('GET', '/book-of-friends-php-component/load_avatar/{id:\d+}', ['App\controllers\HomeController','avatar']);
    $r->addRoute('POST', '/book-of-friends-php-component/load_avatar/{id:\d+}', ['App\controllers\HomeController','avatar']);
    $r->addRoute('GET', '/book-of-friends-php-component/addUser', ['App\controllers\UserController','addUser']);
    $r->addRoute('POST', '/book-of-friends-php-component/addUser', ['App\controllers\UserController','addUser']);
    $r->addRoute('GET', '/book-of-friends-php-component/about', ['App\controllers\HomeController','about']);
    $r->addRoute('GET', '/book-of-friends-php-component/roles/{id:\d+}', ['App\controllers\UserController','roles']);
    $r->addRoute('POST', '/book-of-friends-php-component/roles/{id:\d+}', ['App\controllers\UserController','roles']);
    $r->addRoute('GET', '/book-of-friends-php-component/delete/{id:\d+}', ['App\controllers\UserController','delete']);
    $r->addRoute('POST', '/book-of-friends-php-component/delete/{id:\d+}', ['App\controllers\UserController','delete']);
    $r->addRoute('GET', '/book-of-friends-php-component/security_admin/{id:\d+}', ['App\controllers\UserController','security_admin']);
    $r->addRoute('POST', '/book-of-friends-php-component/security_admin/{id:\d+}', ['App\controllers\UserController','security_admin']);
    $r->addRoute('GET', '/book-of-friends-php-component/security/{id:\d+}', ['App\controllers\UserController','security']);
    $r->addRoute('POST', '/book-of-friends-php-component/security/{id:\d+}', ['App\controllers\UserController','security']);
    $r->addRoute('GET', '/book-of-friends-php-component/paginator', ['App\controllers\HomeController','paginator']);
    $r->addRoute('GET', '/book-of-friends-php-component/confirm_password/{id:\d+}', ['App\controllers\UserController','confirm_password']);
    $r->addRoute('POST', '/book-of-friends-php-component/confirm_password/{id:\d+}', ['App\controllers\UserController','confirm_password']);
    
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








