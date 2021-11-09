<?php $this->layout('layout', ['title' => 'Page profile']); 
$pdo = new PDO("mysql:host=localhost:8889; dbname=app3; charset=utf8;","root","root");
$auth = new \Delight\Auth\Auth($pdo);
?>

<br>
        <main id="js-page-content" role="main" class="page-content mt-3">
        <br><br>
            <div class="subheader">
                <h1 class="subheader-title">
                    <i class='subheader-icon fal fa-user'></i> <?=$user['username'];?>
                </h1>
            </div>
            <div class="row">
              <div class="col-lg-6 col-xl-6 m-auto">
              
                    <!-- profile summary -->
                    <div class="card mb-g" style="border-radius: 25px; background-color: rgb(220 220 220)">
                        <div class="row no-gutters row-grid">
                            <div class="info-card-text flex-1 ml-3 mt-1">
                                                    <a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">
                                                        <?=$user['username'];?>
                                                        <i class="fal fas fa-cog fa-fw d-inline-block ml-1 fs-md"></i>
                                                        <i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
                                                    </a>
                                                
                                                    <div class="dropdown-menu " style="border-radius: 25px; background-color: rgb(200 200 200); z-index: 1075;">
                                                                    <?php if($auth->isLoggedIn()):?>
                                                                    <a class="dropdown-item" href="/">
                                                                        <i class="fa fa-edit"></i>
                                                                        Перейти на главную</a> 
                                                                        <?php endif;?> 
                                                                        <?php if($auth->hasRole(\Delight\Auth\Role::SUPER_ADMIN) OR $auth->hasRole(\Delight\Auth\Role::ADMIN) OR $auth->hasRole(\Delight\Auth\Role::DEVELOPER)):?> 
                                                                        <a class="dropdown-item" href="/roles/<?=$user['id'];?>">
                                                                        <i class="fa fa-edit"></i>
                                                                        Управлять ролями</a>
                                                                        <?php endif;?>
                                                                        <?php if($auth->hasRole(\Delight\Auth\Role::SUPER_ADMIN) OR $auth->hasRole(\Delight\Auth\Role::ADMIN) OR $auth->hasRole(\Delight\Auth\Role::DEVELOPER) OR $auth->getUsername()==$user['username']):?> 
                                                                        <a class="dropdown-item" href="/edit_user/<?=$user['id'];?>">
                                                                        <i class="fa fa-edit"></i>
                                                                        Редактировать</a>
                                                                        <a class="dropdown-item" href="/security_admin/<?=$user['id'];?>">
                                                                        <i class="fa fa-lock"></i>
                                                                        Безопасность</a>
                                                                        <a class="dropdown-item" href="/security/<?=$user['id'];?>">
                                                                        <i class="fa fa-lock"></i>
                                                                        Изменить данные пользователя</a>
                                                                        <a class="dropdown-item" href="/status/<?=$user['id'];?>">
                                                                        <i class="fa fa-sun"></i>
                                                                        Установить статус</a>
                                                                        <a class="dropdown-item" href="/load_avatar/<?=$user['id'];?>">
                                                                        <i class="fa fa-camera"></i>
                                                                        Управлять аватаром
                                                                        </a>
                                                                        <a href="/deleteShow/<?=$user['id']?>" class="dropdown-item" onclick="return confirm('are you sure?');">
                                                                        <i class="fa fa-window-close"></i>
                                                                        Удалить
                                                                        </a>   
                                                                        <?php endif;?> 
                                                                        <?php if($auth->isLoggedIn() == false):?>
                                                                        
                                                                        <i class="fa fa-edit"></i>
                                                                        Вы не можете откыть профиль пользователя</a> 
                                                                        <?php endif;?> 
                                                    </div>    
                                                <span class="text-truncate text-truncate-xl"><?=$user['occupation'];?></span> 
                                                </div>         
                                                <button class="js-expand-btn btn btn-sm btn-default d-none" data-toggle="collapse" data-target="#c_1 > .card-body + .card-body" aria-expanded="false">
                                                    <span class="collapsed-hidden">+</span>
                                                    <span class="collapsed-reveal">-</span>
                                                </button>
                                
                                <?php if($user['status']==0):?>
                                                    <span class="status status-success mr-6"> <p class="ml-3 mr-3 mt-1">Активность</p>
                                                <?php endif;?>
                                                <?php if($user['status']==1):?>
                                                    <span class="status status-warning mr-6"> <p class="ml-3 mr-3 mt-1">Нет на месте</p>
                                                <?php endif;?> 
                                                <?php if($user['status']==2):?>
                                                    <span class="status status-danger mr-6"> <p class="ml-3 mr-3 mt-1">Не беспокоить</p>
                                                <?php endif;?>
                                                
                                                </span>                
                            </div> 
                             
                            <div class="col-12">
                                <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                    <img src="/book-of-friends-php-component/public/uploads/<?=$user['avatar'];?>" class="rounded-circle shadow-2 img-thumbnail" alt="">
                                    <h5 class="mb-0 fw-700 text-center mt-3">
                                    <?=$user['username'];?>
                                        <small class="text-muted mb-0"><?=$user['city'];?></small>
                                    </h5>
                                    <div class="mt-4 text-center demo">
                                        <a href="javascript:void(0);" class="fs-xl" style="color:#C13584">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="fs-xl" style="color:#4680C2">
                                            <i class="fab fa-vk"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="fs-xl" style="color:#0088cc">
                                            <i class="fab fa-telegram"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 text-center">
                                    <a href="tel:+13174562564" class="mt-1 d-block fs-sm fw-400 text-dark">
                                        <i class="fas fa-mobile-alt text-muted mr-2"></i> <?=$user['phone'];?></a>
                                    <a href="mailto:oliver.kopyov@marlin.ru" class="mt-1 d-block fs-sm fw-400 text-dark">
                                        <i class="fas fa-mouse-pointer text-muted mr-2"></i> <?=$user['email'];?></a>
                                    <address class="fs-sm fw-400 mt-4 text-muted">
                                        <i class="fas fa-map-pin mr-2"></i> <?=$user['occupation'];?>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </main>

    <script src="/php/lessons_php/module_2/module_2_training_project/app/views/js/vendors.bundle.js"></script>
    <script src="/php/lessons_php/module_2/module_2_training_project/app/views/js/app.bundle.js"></script>
    <script>

        $(document).ready(function()
        {

        });

    </script>
