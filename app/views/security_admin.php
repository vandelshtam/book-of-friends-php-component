<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        Secutity admin
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
<body>
    <div class="blankpage-form-field">
        <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded-plus border-bottom-left-radius-0 border-bottom-right-radius-0 px-4 " style="background-color: rgb(0 0 0);">
            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                <img src="/type2.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                <span class="page-logo-text mr-1">Book-of-friends</span>
                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
            </a>
        </div>
        <div class="card p-4 rounded-plus border-top-left-radius-0 border-top-right-radius-0">
            
            <?php echo flash()->display();?>
            
            <form action="" method="POST">
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="username" id="username" class="form-control" placeholder="username" value="" name="username">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Пароль</label>
                    <input type="password" id="password" class="form-control" placeholder="" name="newPassword">
                </div>
                <div class="form-group text-left">
                    
                </div>
                <button type="submit" class="btn btn-default float-right" name="security_name">Подтвердить смену пароля</button>
            </form>
        </div>
        <div class="blankpage-footer text-center text-danger">
            Нет аккаунта? <a class=" text-danger" href="/registerShow"><strong>Зарегистрироваться</strong>
        </div>
    </div>
    <video poster="/book-of-friends-php-component/app/views/img/backgrounds/clouds.png" id="bgvid" playsinline autoplay muted loop>
        <source src="/book-of-friends-php-component/app/views/media/video/cc.webm" type="video/webm">
        <source src="/book-of-friends-php-component/app/views/media/video/cc.mp4" type="video/mp4">
    </video>
    <script src="/book-of-friends-php-component/app/views/js/vendors.bundle.js"></script>
</body>
</html>
