
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>verification</title>
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
    <link rel="apple-touch-icon" sizes="180x180" href="/php/lessons_php/module_2/module_2_training_project/app/views/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/book-of-friends-php-component/app/views/img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="/book-of-friends-php-component/app/views/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="/book-of-friends-php-component/app/views/css/fa-brands.css">
    <link rel="stylesheet" type="text/css" href="/book-of-friends-php-component/app/views/css/style.css">  
</head>
<body>
    <div class="page-wrapper auth">
        <div class="page-inner bg-secondary bg-secondary-gradient">
            <div class="page-content-wrapper bg-transparent m-0">
                <div class="height-10 w-100 shadow-lg px-4 navBackground">
                    <div class="d-flex align-items-center container p-0">
                        <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9 border-0">
                            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                                <img src="/book-of-friends-php-component/app/views/img/type2.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                                <span class="page-logo-text mr-1">Book-of-friends</span>
                            </a>
                        </div>
                        <span class="text-white opacity-50 ml-auto mr-2 hidden-sm-down">
                            Уже зарегистрированы?
                        </span>
                        <a href="/book-of-friends-php-component/login" class="btn-link text-white ml-auto ml-sm-0">
                            Войти
                        </a>
                    </div>
                </div>
                <div class="flex-1" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                        <div class="row">
                            <div class="col-xl-12">
                                <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
                                    Верификация email
                                    <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60 hidden-sm-down">
                                        Пожалуйста пройдите верификацию.
                                        <br> 
                                        Слейдуйте рекомендациям системы.
                                        
                                    </small>
                                </h2>
                            </div>
                            <div class="col-xl-6 ml-auto mr-auto">
                                <div class="card p-4  bg-faded" style="border-radius: 25px;">
                                    
                                    <br><br>    <strong>Уведомление!</strong> <?=flash()->display();?>
                                    
                                    <form id="js-login" novalidate="" action="" method="POST">
                                        
                                        <div class="form-group">
                                            <label class="form-label" for="emailverify">Code</label>
                                            <input type="username" id="emailverify" class="form-control rounded-plus" placeholder="Code" name="code" required>
                                            <div class="invalid-feedback">Заполните поле.</div>
                                            <div class="help-block">Введите пароль</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="emailverify">Tokin</label>
                                            <input type="username" id="emailverify" class="form-control rounded-plus" placeholder="Tokin" name="tokin" required>
                                            <div class="invalid-feedback">Заполните поле.</div>
                                            <div class="help-block">Введите токин</div>
                                        </div>
                                       
                                        <div class="row no-gutters">
                                            <div class="col-md-4 ml-auto text-right">
                                                <button id="js-login-btn" type="submit" class="btn btn-block btn-danger btn-lg mt-3 rounded-plus">Верифицировать</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN Page Footer -->
    <footer class="page-footer" role="contentinfo">
            <div class="d-flex align-items-center flex-1 text-muted">
                <span class="hidden-md-down fw-700">2021 © Book-of-friends</span>
            </div>
            <div>
                <ul class="list-table ml-3">
                    <li><a href="/book-of-friends-php-component/home" class="text-secondary fw-700">Home</a></li>
                    <li class="pl-3"><a href="/book-of-friends-php-component/about" class="text-secondary fw-700">About</a></li>
                </ul>
            </div>
        </footer>    
    <script src="/book-of-friends-php-component/app/views/js/vendors.bundle.js"></script>
    <script>
        $("#js-login-btn").click(function(event)
        {

            // Fetch form to apply custom Bootstrap validation
            var form = $("#js-login")

            if (form[0].checkValidity() === false)
            {
                event.preventDefault()
                event.stopPropagation()
            }

            form.addClass('was-validated');
            // Perform ajax submit here...
        });

    </script>
</body>
</html>
