<?php 
$this->layout('layout', ['title' => 'Security']);
$pdo = new PDO("mysql:host=localhost:8889; dbname=app3; charset=utf8;","root","root");
$auth = new \Delight\Auth\Auth($pdo);
?>

    <main id="js-page-content" role="main" class="page-content mt-6">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-lock'></i> Безопасность
            </h1>
        </div>
        <br><br>
        <strong class="rounded-plus"><?php echo flash()->display();?></strong> 
        <form action="" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel" style="border-radius: 25px; background-color: rgb(220 220 220)">
                        <div class="panel-container" >
                            <div class="panel-hdr" style="border-radius: 25px; background-color: rgb(220 220 220)">
                                <h2>Обновление эл. адреса и пароля</h2>
                            </div>
                            <div class="panel-hdr" style=" background-color: rgb(220 220 220)">
                                <p>Если вам нужно изменить только электронную почту, то в поля 'пароль' и 'подтверждение пароля' введите свой действующий пароль.</p>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Username</label>
                                    <input type="text" id="simpleinput" class="form-control rounded-plus" value="<?=$user['username'];?>" name="username">
                                </div>

                                <!-- email -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Email</label>
                                    <input type="email" id="simpleinput" class="form-control rounded-plus" value="<?=$user['email'];?>" name="email">
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Пароль</label>
                                    <input type="password" id="simpleinput" class="form-control rounded-plus" name="password">
                                </div>

                                <!-- password confirmation-->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Подтверждение пароля</label>
                                    <input type="password" id="simpleinput" class="form-control rounded-plus" name="confirm">
                                </div>


                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning rounded-plus" type="submit">Изменить</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="/book-of-friends-php-component/app/views/js/vendors.bundle.js"></script>
    <script src="/book-of-friends-php-component/app/views/js/app.bundle.js"></script>
    
