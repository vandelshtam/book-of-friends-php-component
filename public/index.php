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
    $r->addRoute('GET', '/', ['App\controllers\HomeController','home']);
    $r->addRoute('GET', '/page_profile/{id:\d+}', ['App\controllers\HomeController','page_profile']);
    $r->addRoute('GET', '/edit_user/{id:\d+}', ['App\controllers\UserController','edit']);
    $r->addRoute('POST', '/edit_user/{id:\d+}', ['App\controllers\UserController','edit']);
    $r->addRoute('GET', '/register', ['App\controllers\UserController','register']);
    $r->addRoute('POST', '/register', ['App\controllers\UserController','register']);
    $r->addRoute('GET', '/registerShow', ['App\controllers\UserController','registerShow']);
    $r->addRoute('POST', '/registerShow', ['App\controllers\UserController','registerShow']);
    $r->addRoute('GET', '/verification/{id:\d+}', ['App\controllers\UserController','email_verification']);
    $r->addRoute('POST', '/verification/{id:\d+}', ['App\controllers\UserController','email_verification']);
    $r->addRoute('GET', '/verification', ['App\controllers\UserController','email_verification']);
    $r->addRoute('POST', '/verification', ['App\controllers\UserController','email_verification']);
    $r->addRoute('GET', '/login', ['App\controllers\UserController','login']);
    $r->addRoute('POST', '/login', ['App\controllers\UserController','login']);
    $r->addRoute('GET', '/logout', ['App\controllers\UserController','logout']);
    $r->addRoute('GET', '/status/{id:\d+}', ['App\controllers\HomeController','status']);
    $r->addRoute('POST', '/status/{id:\d+}', ['App\controllers\HomeController','status']);
    $r->addRoute('GET', '/statusShow/{id:\d+}', ['App\controllers\HomeController','statusShow']);
    $r->addRoute('POST', '/statusShow/{id:\d+}', ['App\controllers\HomeController','statusShow']);
    $r->addRoute('GET', '/load_avatar/{id:\d+}', ['App\controllers\HomeController','avatar']);
    $r->addRoute('POST', '/load_avatar/{id:\d+}', ['App\controllers\HomeController','avatar']);
    $r->addRoute('GET', '/addUser', ['App\controllers\UserController','addUser']);
    $r->addRoute('POST', '/addUser', ['App\controllers\UserController','addUser']);
    $r->addRoute('GET', '/about', ['App\controllers\HomeController','about']);
    $r->addRoute('GET', '/roles/{id:\d+}', ['App\controllers\UserController','roles']);
    $r->addRoute('POST', '/roles/{id:\d+}', ['App\controllers\UserController','roles']);
    $r->addRoute('GET', '/delete/{id:\d+}', ['App\controllers\UserController','delete']);
    $r->addRoute('POST', '/delete/{id:\d+}', ['App\controllers\UserController','delete']);
    $r->addRoute('GET', '/deleteShow/{id:\d+}', ['App\controllers\UserController','deleteShow']);
    $r->addRoute('POST', '/deleteShow/{id:\d+}', ['App\controllers\UserController','deleteShow']);
    $r->addRoute('GET', '/security_admin/{id:\d+}', ['App\controllers\UserController','security_admin']);
    $r->addRoute('POST', '/security_admin/{id:\d+}', ['App\controllers\UserController','security_admin']);
    $r->addRoute('GET', '/security/{id:\d+}', ['App\controllers\UserController','security']);
    $r->addRoute('POST', '/security/{id:\d+}', ['App\controllers\UserController','security']);
    $r->addRoute('GET', '/paginator', ['App\controllers\HomeController','paginator']);
    $r->addRoute('GET', '/confirm_passwordShow/{id:\d+}', ['App\controllers\UserController','confirm_passwordShow']);
    $r->addRoute('POST', '/confirm_passwordShow/{id:\d+}', ['App\controllers\UserController','confirm_passwordShow']);
    $r->addRoute('GET', '/confirm_password/{id:\d+}', ['App\controllers\UserController','confirm_password']);
    $r->addRoute('POST', '/confirm_password/{id:\d+}', ['App\controllers\UserController','confirm_password']);
    
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








