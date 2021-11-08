<?php 
$this->layout('layout', ['title' => 'List all users']);
$pdo = new PDO("mysql:host=localhost:8889; dbname=app3; charset=utf8;","root","root");
$auth = new \Delight\Auth\Auth($pdo);
?>

    <main id="js-page-content" role="main" class="page-content mt-0">
    
            <div class="row mt-6 sticky-top mt-0">
                <div class="col-xl-12">
                    <?php if($auth->hasRole(\Delight\Auth\Role::SUPER_ADMIN) OR $auth->hasRole(\Delight\Auth\Role::ADMIN) OR $auth->hasRole(\Delight\Auth\Role::DEVELOPER)):?>
                    <a class="btn btn-dark text-white" style="border-radius: 10px;"  href="/book-of-friends-php-component/addUser">Добавить</a>
                    <?php else:?>
                    <br><br>
                    <?php endif;?>
                    <div class="border-faded bg-faded p-3 mb-g d-flex mt-3 mt-6 sticky-top" style="border-radius: 25px; background-color: rgb(220 220 220)">
                        <input type="text" id="js-filter-contacts" name="filter-contacts" class="form-control shadow-inset-2 form-control-lg"  style="border-radius: 10px;" placeholder="Найти пользователя">
                        <div class="btn-group btn-group-lg btn-group-toggle hidden-lg-down ml-3"  data-toggle="buttons">
                            <label class="btn btn-default active">
                                <input type="radio" name="contactview" id="grid" checked="" value="grid"><i class="fas fa-table"></i>
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="contactview" id="table" value="table"><i class="fas fa-th-list"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="subheader">
                <h1 class="subheader-title">
                    <i class='subheader-icon fal fa-users'></i> 
                    Список пользователей 
                    <ul class="navbar-nav ml-auto mt-3">   
                    <li class="nav-item" class="row">    
                        <a class="nav-link text-secondary" href="/book-of-friends-php-component/paginator">Показывать по три пользователя</a>
                    </li> 
                </ul>   
                </h1>
            </div>
            <div class="row" id="js-contacts">
                <?php foreach($users as $user):?>
                    <div class="col-xl-4" >
                        <div id="<?=$user['c'];?>" class="card border shadow-0 mb-g shadow-sm-hover" data-filter-tags="<?=$user['search'];?>" style='border-radius: 25px; background-color: rgb(235 235 235)'>
                            <div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top" >
                                <div class="d-flex flex-row align-items-center">
                                        <?php if($user['status']==0):?>
                                                    <span class="status status-success mr-3">
                                                <?php endif;?>
                                                <?php if($user['status']==1):?>
                                                    <span class="status status-warning mr-3">
                                                <?php endif;?> 
                                                <?php if($user['status']==2):?>
                                                    <span class="status status-danger mr-3">
                                                <?php endif;?>
                                                <?php if($user['avatar']=='avatar-m.png'):?>
                                                    <span class="rounded-circle profile-image d-block " style="background-image:url('/book-of-friends-php-component/app/views/img/demo/avatars/<?=$user['avatar'];?>'); background-size: cover;"></span>
                                                <?php else:?> 
                                                    <span class="rounded-circle profile-image d-block " style="background-image:url('/book-of-friends-php-component/public/uploads/<?=$user['avatar'];?>'); background-size: cover;"></span>
                                                <?php endif;?> 
                                                </span>
                                                    <div class="info-card-text flex-1">
                                                        <a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">
                                                            <?=$user['username'];?>
                                                            <i class="fal fas fa-cog fa-fw d-inline-block ml-1 fs-md"></i>
                                                            <i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
                                                        </a>
                                                    
                                                        <div class="dropdown-menu " style="border-radius: 25px; background-color: rgb(200 200 200); z-index: 1075;">
                                                                        <?php if($auth->isLoggedIn()):?>
                                                                        <a class="dropdown-item" href="/page_profile/<?=$user['id'];?>">
                                                                            <i class="fa fa-edit"></i>
                                                                            Открыть профиль</a> 
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
                                                                            <a class="dropdown-item" href="/book-of-friends-php-component/security_admin/<?=$user['id'];?>">
                                                                            <i class="fa fa-lock"></i>
                                                                            Безопасность</a>
                                                                            <a class="dropdown-item" href="/book-of-friends-php-component/security/<?=$user['id'];?>">
                                                                            <i class="fa fa-lock"></i>
                                                                            Изменить данные пользователя</a>
                                                                            <a class="dropdown-item" href="/book-of-friends-php-component/statusShow/<?=$user['id'];?>">
                                                                            <i class="fa fa-sun"></i>
                                                                            Установить статус</a>
                                                                            <a class="dropdown-item" href="/book-of-friends-php-component/load_avatar/<?=$user['id'];?>">
                                                                            <i class="fa fa-camera"></i>
                                                                            Управлять аватаром
                                                                            </a>
                                                                            <a href="/book-of-friends-php-component/deleteShow/<?=$user['id']?>" class="dropdown-item" onclick="return confirm(\'are you sure?\');">
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
                                </div>   
                            </div>
                                <div class="card-body p-0 collapse show">
                                    <?php if($auth->isLoggedIn()):?>   
                                                <div class="p-3">
                                                    <a href="tel:+<?=$user['phone'];?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                                                    <i class="fas fa-mobile-alt text-muted mr-2"></i><?=$user['phone'];?></a>
                                                    <a href="mailto:<?=$user['email'];?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                                                    <i class="fas fa-mouse-pointer text-muted mr-2"></i><?=$user['email'];?></a>
                                                    <address class="fs-sm fw-400 mt-4 text-muted">
                                                    <i class="fas fa-map-pin mr-2"></i><?=$user['city'];?></address>
                                                        <div class="d-flex flex-row">
                                                            <a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#4680C2">
                                                            <i class="fab fa-vk"><?=$user['vk'];?></i>
                                                            </a>
                                                            <a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#38A1F3">
                                                            <i class="fab fa-telegram"><?=$user['telegram'];?></i>
                                                            </a>
                                                            <a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#E1306C">
                                                            <i class="fab fa-instagram"><?=$user['instagram'];?></i>
                                                            </a>
                                                        </div>
                                                </div>        
                                    <?php else:?>    
                                            <div class="subheader">                        
                                                <i class='subheader-icon fal fa-users ml-3'></i> 
                                                Информация для зарегистрированных пользователей   
                                                        
                                                <a href="/book-of-friends-php-component/login" class="btn-link text-dark ml-auto ">
                                                Войти
                                                </a>
                                                <div class="blankpage-footer text-center ml-3 mr-3">
                                                Нет аккаунта? <a href="/book-of-friends-php-component/register"><strong>Зарегистрироваться</strong>
                                                </div>
                                            </div>     
                                    <?php endif;?> 
                                </div>                        
                        </div>
                    </div>
                <?php endforeach;?>
            </div>    
    </main>
    <script src="/book-of-friends-php-component/app/views/js/vendors.bundle.js"></script>
    <script src="/book-of-friends-php-component/app/views/js/app.bundle.js"></script>
    <script>

    $(document).ready(function()
            {

                $('input[type=radio][name=contactview]').change(function()
                    {
                        if (this.value == 'grid')
                        {
                            $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
                            $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
                            $('#js-contacts .js-expand-btn').addClass('d-none');
                            $('#js-contacts .card-body + .card-body').addClass('show');

                        }
                        else if (this.value == 'table')
                        {
                            $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
                            $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
                            $('#js-contacts .js-expand-btn').removeClass('d-none');
                            $('#js-contacts .card-body + .card-body').removeClass('show');
                        }

                    });

                    //initialize filter
                    initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));
            });
</script>    