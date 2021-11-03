
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        Подтверждение пароля
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="/php/lessons_php/module_2/module_2_training_project/app/views/css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="/php/lessons_php/module_2/module_2_training_project/app/views/css/app.bundle.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link id="myskin" rel="stylesheet" media="screen, print" href="/php/lessons_php/module_2/module_2_training_project/app/views/css/skins/skin-master.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="/php/lessons_php/module_2/module_2_training_project/app/views/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/php/lessons_php/module_2/module_2_training_project/app/views/img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="/php/lessons_php/module_2/module_2_training_project/app/views/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="/php/lessons_php/module_2/module_2_training_project/app/views/css/page-login-alt.css">
</head>
<body>
    <div class="blankpage-form-field">
        <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                <img src="/php/lessons_php/module_2/module_2_training_project/app/views/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                <span class="page-logo-text mr-1">Учебный проект</span>
                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
            </a>
        </div>
        <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
            
            <?php echo flash()->display();?>
            
            <form action="" method="POST">
                
                <div class="form-group">
                    <label class="form-label" for="password">Пароль</label>
                    <input type="password" id="password" class="form-control" placeholder="" name="c_password">
                </div>
                <div class="form-group text-left">
                    
                </div>
                <button type="submit" class="btn btn-default float-right" name="confirm">Подтвердить пароль</button>
            </form>
        </div>
        <div class="blankpage-footer text-center">
            Нет аккаунта? <a href="/php/lessons_php/module_2/module_2_training_project/public/index.php/register"><strong>Зарегистрироваться</strong>
        </div>
    </div>
    <video poster="/php/lessons_php/module_2/module_2_training_project/app/views/img/backgrounds/clouds.png" id="bgvid" playsinline autoplay muted loop>
        <source src="/php/lessons_php/module_2/module_2_training_project/app/views/media/video/cc.webm" type="video/webm">
        <source src="/php/lessons_php/module_2/module_2_training_project/app/views/media/video/cc.mp4" type="video/mp4">
    </video>
    <script src="/php/lessons_php/module_2/module_2_training_project/app/views/js/vendors.bundle.js"></script>
</body>
</html>
