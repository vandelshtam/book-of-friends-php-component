<?php
$pdo = new PDO("mysql:host=localhost:8889; dbname=app3; charset=utf8;","root","root");
$auth = new \Delight\Auth\Auth($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->e($title)?></title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="/book-of-friends-php-component/app/views/css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="/book-of-friends-php-component/app/views/css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="/book-of-friends-php-component/app/views/css/skins/skin-master.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link rel="stylesheet" media="screen, print" href="/book-of-friends-php-component/app/views/css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="/book-of-friends-php-component/app/views/css/fa-brands.css">
    <link rel="stylesheet" media="screen, print" href="/book-of-friends-php-component/app/views/css/fa-regular.css">
</head>

    <body class="mod-bg-1 mod-nav-link">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top mb-6" style='background-color: rgb(0 0 0)'>
            <a class="navbar-brand d-flex align-items-center fw-500" href="users.html"><img alt="logo" class="d-inline-block align-top mr-2" src="/book-of-friends-php-component/app/views/img/type2.png" style="width: 35px;"> Book-of-friends</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/book-of-friends-php-component/home">Главная <span class="sr-only">(current)</span></a>
                    </li> 
                </ul>
                
                
                <ul class="navbar-nav md-3 mt-3"> 
                     <?php if($auth->hasRole(\Delight\Auth\Role::SUPER_ADMIN) OR $auth->hasRole(\Delight\Auth\Role::ADMIN)) :?>
                    <li class="nav-item" >
                        <p class="nav-link">Вы администратор</p>
                    </li>    
                    <?php elseif($auth->hasRole(\Delight\Auth\Role::MODERATOR) OR $auth->hasRole(\Delight\Auth\Role::DEVELOPER)):?>
                    <li class="nav-item" >
                        <p class="nav-link">Вы разработчик</p>
                    </li> 
                    <?php endif;?>   
                </ul>
                
               
                <ul class="navbar-nav md-3 mt-3"> 
                    <?php if($auth->isLoggedIn()):?>  
                    <li class="nav-item" >
                        <p class="nav-link">Вы вошли как - "<?php echo $username = $auth->getUsername();?>"</p>
                    </li> 
                    <?php endif;?>   
                </ul>
                
                <ul class="navbar-nav md-3">   
                <?php if($auth->isLoggedIn()):?>
                    <li class="nav-item" >
                        <a class="nav-link" href="/book-of-friends-php-component/logout">Выйти</a>
                    </li>
                    <?php else:?>
                    <li class="nav-item" >
                        <a class="nav-link" href="/book-of-friends-php-component/login">Войти</a>
                    </li>
                    <?php endif;?>
                </ul>
            </div>
        </nav>

            <?php echo flash()->display();?>
            <?=$this->section('content')?>
            <title><?=$this->e($name)?></title>
     
        <!-- BEGIN Page Footer -->
        <footer class="page-footer" role="contentinfo">
            <div class="d-flex align-items-center flex-1 text-muted">
                <span class="hidden-md-down fw-700">2021 © Book-of-friends</span>
            </div>
            <div>
                <ul class="list-table m-0">
                    <li><a href="/book-of-friends-php-component/home" class="text-secondary fw-700">Home</a></li>
                    <li class="pl-3"><a href="/book-of-friends-php-component/about" class="text-secondary fw-700">About</a></li>
                </ul>
            </div>
        </footer>
        
    </body>

    
</html>