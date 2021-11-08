<?php $this->layout('layout', ['title' => 'Media']);
$pdo = new PDO("mysql:host=localhost:8889; dbname=app3; charset=utf8;","root","root");
$auth = new \Delight\Auth\Auth($pdo);
 ?>

    <main id="js-page-content" role="main" class="page-content mt-3">
    <br><br><br>
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-image'></i> Загрузить аватар
            </h1>

        </div>
        
        <div class="card mb-g" style="border-radius: 25px; background-color: rgb(220 220 220)">
                        <div class="row no-gutters row-grid">
                            <div class="info-card-text flex-1 ml-3 mt-1">
                                                    <a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">
                                                        
                                                        <i class="fal fas fa-cog fa-fw d-inline-block ml-1 fs-md"></i>
                                                        <i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
                                                    </a>
                                                
                                                    <div class="dropdown-menu " style="border-radius: 25px; background-color: rgb(200 200 200); z-index: 1075;">
                                                                    <?php if($auth->isLoggedIn()):?>
                                                                    <a class="dropdown-item" href="/book-of-friends-php-component/home">
                                                                        <i class="fa fa-edit"></i>
                                                                        Перейти на главную</a> 
                                                                    <a class="dropdown-item" href="/book-of-friends-php-component/page_profile/<?=$id;?>">
                                                                        <i class="fa fa-edit"></i>
                                                                        Перейти к профилю</a> 
                                                                        <?php endif;?>                         
                                                </div>         
                                                <button class="js-expand-btn btn btn-sm btn-default d-none" data-toggle="collapse" data-target="#c_1 > .card-body + .card-body" aria-expanded="false">
                                                    <span class="collapsed-hidden">+</span>
                                                    <span class="collapsed-reveal">-</span>
                                                </button> 
                            </div>
                        </div>  
                                            
        <br><br>                                        
        <?php echo flash()->display();?>                        
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row" >
                <div class="col-xl-6" >
                    <div id="panel-1" class="panel" style="border-radius: 25px; background-color: rgb(230 230 230)">
                        <div class="panel-container" >
                            <div class="panel-hdr" style="border-radius: 25px; background-color: rgb(230 230 230)">
                                <h2>Текущий аватар</h2>
                            </div>
                            <div class="panel-content">
                                <div class="form-group">
                                    <?php if($current_avatar==true) { ;?>
                                    <img src="/book-of-friends-php-component/public/uploads/<?php echo $avatar;?>" alt="" class="img-responsive" width="200">
                                    <?php } else{ ;?>
                                    <img src="/book-of-friends-php-component/img/demo/avatars/avatar-m.png" alt="" class="img-responsive" width="200">
                                    <?php };?>   
                                </div>

                                <div class="form-group">
                                    <label class="form-label rounded-plus" for="example-fileinput">Выберите аватар</label>
                                    <input type="file" id="example-fileinput" name="avatar" class="form-control-file">
                                </div>


                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning" name="send_update">Загрузить</button>
                                    
                                </div>
                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning" name="send_delete">Удалить</button>
                                    
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