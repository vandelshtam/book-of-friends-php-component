<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        Войти
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="/book-of-friends-php-component/app/views/css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="/book-of-friends-php-component/app/views/css/app.bundle.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link id="myskin" rel="stylesheet" media="screen, print" href="/book-of-friends-php-component/app/views/css/skins/skin-master.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="/book-of-friends-php-component/app/views/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/book-of-friends-php-component/app/views/img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="/book-of-friends-php-component/app/views/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="/book-of-friends-php-component/app/views/css/page-login-alt.css">
    <link rel="stylesheet" type="text/css" href="/book-of-friends-php-component/app/views/css/style.css">  
</head>
<body class="bodyRegisterBackground">
    <div class="blankpage-form-field">
        <div class="page-logo m-0 w-100 align-items-center justify-content-center  navBackground" style="border-radius: 20px 20px 0px 0px;">
            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                <img src="/book-of-friends-php-component/app/views/img/type2.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                <span class="page-logo-text mr-1">Book-of-friends</span>
                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
            </a>
        </div>
        <div class="card p-4 border_radius_top profileCardBackground" style="border-radius: 0px 0px 20px 20px;">
            
        <strong class="rounded-plus"><?php echo flash()->display();?></strong> 
            
            <form action="" method="POST">
                <div class="form-group">
                    <label class="form-label" for="username">Email</label>
                    <input type="email" id="username" class="form-control rounded-plus"  placeholder="Эл. адрес" value="" name="email">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Пароль</label>
                    <input type="password" id="password" class="form-control rounded-plus"  placeholder="" name="password">
                </div>
                <div class="form-group text-left">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="rememberme" name="rememberme">
                        <label class="custom-control-label" for="rememberme">Запомнить меня</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark float-right rounded-plus"  name="login">Войти</button>
            </form>
        </div>
        <div class="blankpage-footer text-center text-danger">
            Нет аккаунта? <a class="text-danger" href="/book-of-friends-php-component/register"><strong>Зарегистрироваться</strong>
        </div>
    </div>
    
    <script src="/book-of-friends-php-component/app/views/js/vendors.bundle.js"></script>
</body>
</html>
