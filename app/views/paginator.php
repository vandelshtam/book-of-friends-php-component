<?php 
$this->layout('layout', ['title' => 'List all users']);
$pdo = new PDO("mysql:host=localhost:8889; dbname=app3; charset=utf8;","root","root");
$auth = new \Delight\Auth\Auth($pdo);
?>
    <main id="js-page-content" role="main" class="page-content mt-3">
            <div class="row">
                <div class="col-xl-12">
                    <?php if($auth->hasRole(\Delight\Auth\Role::SUPER_ADMIN) OR $auth->hasRole(\Delight\Auth\Role::ADMIN) OR $auth->hasRole(\Delight\Auth\Role::DEVELOPER)):?>
                    <a class="btn btn-success" href="/book-of-friends-php-component/addUser">Добавить</a>
                    <?php endif;?>
                    <div class="border-faded bg-faded p-3 mb-g d-flex mt-3">
                        <input type="text" id="js-filter-contacts" name="filter-contacts" class="form-control shadow-inset-2 form-control-lg" placeholder="Найти пользователя">
                        <div class="btn-group btn-group-lg btn-group-toggle hidden-lg-down ml-3" data-toggle="buttons">
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
                        <a class="nav-link" href="/book-of-friends-php-component/home">Показать всех пользователей</a>
                        
                    </li> 
                </ul>   
                </h1>
            </div>
            <?php foreach($users as $user):?>
            <div class="row" id="js-contacts">
                <div class="col-xl-4">
                    <div id="c_1" class="card border shadow-0 mb-g shadow-sm-hover" data-filter-tags="oliver kopyov">
                        <div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
                            <div class="d-flex flex-row align-items-center">
                                <span class="status status-success mr-3">
                                    <span class="rounded-circle profile-image d-block " style="background-image:url('<?=$user['avatar'];?>'); background-size: cover;"></span>
                                </span>
                                <div class="info-card-text flex-1">
                                    <a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">
                                        <?=$user['username'];?>
                                        <i class="fal fas fa-cog fa-fw d-inline-block ml-1 fs-md"></i>
                                        <i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
                                    </a>
                                    
                                    <?php if($auth->isLoggedIn()):?>
                                        
                                               <div class="dropdown-menu">
                                               <a class="dropdown-item" href="/book-of-friends-php-component/page_profile/<?=$user['id'];?>">
                                                <i class="fa fa-edit"></i>
                                                Открыть профиль</a> 
                                                <?php endif;?> 
                                                <?php if($auth->hasRole(\Delight\Auth\Role::SUPER_ADMIN) OR $auth->hasRole(\Delight\Auth\Role::ADMIN) OR $auth->hasRole(\Delight\Auth\Role::DEVELOPER)):?> 
                                                <a class="dropdown-item" href="/book-of-friends-php-component/roles/<?=$user['id'];?>">
                                                <i class="fa fa-edit"></i>
                                                Управлять ролями</a>
                                                <?php endif;?>
                                                <?php if($auth->hasRole(\Delight\Auth\Role::SUPER_ADMIN) OR $auth->hasRole(\Delight\Auth\Role::ADMIN) OR $auth->hasRole(\Delight\Auth\Role::DEVELOPER) OR $auth->getUsername()==$user['username']):?> 
                                                <a class="dropdown-item" href="/book-of-friends-php-component/edit_user/<?=$user['id'];?>">
                                                <i class="fa fa-edit"></i>
                                                Редактировать</a>
                                                <a class="dropdown-item" href="/book-of-friends-php-component/security_admin/<?=$user['id'];?>">
                                                <i class="fa fa-lock"></i>
                                                Безопасность</a>
                                                <a class="dropdown-item" href="/book-of-friends-php-component/status/<?=$user['id'];?>">
                                                <i class="fa fa-sun"></i>
                                                Установить статус</a>
                                                <a class="dropdown-item" href="/book-of-friends-php-component/load_avatar/<?=$user['id'];?>">
                                                <i class="fa fa-camera"></i>
                                                Управлять аватаром
                                                </a>
                                                <a href="/book-of-friends-php-component/delete/<?=$user['id']?>" class="dropdown-item" onclick="return confirm(\'are you sure?\');">
                                                <i class="fa fa-window-close"></i>
                                                Удалить
                                                </a>   
                                                </div>        
                                    <?php endif;?> 
                                    </div>
                                <button class="js-expand-btn btn btn-sm btn-default d-none" data-toggle="collapse" data-target="#c_1 > .card-body + .card-body" aria-expanded="false">
                                    <span class="collapsed-hidden">+</span>
                                    <span class="collapsed-reveal">-</span>
                                </button>   
                                    <span class="text-truncate text-truncate-xl"><?=$user['occupation'];?></span>    
                            </div>
                        </div>
                        <?php if($auth->isLoggedIn()):?>   
                        <div class="card-body p-0 collapse show">
                         
                                        <div class="p-3">
                                        <a href="tel:+13174562564" class="mt-1 d-block fs-sm fw-400 text-dark">
                                        <i class="fas fa-mobile-alt text-muted mr-2"></i><?=$user['phone'];?></a>
                                        <a href="mailto:oliver.kopyov@smartadminwebapp.com" class="mt-1 d-block fs-sm fw-400 text-dark">
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
                                        <h6 class="subheader-title">
                                        <i class='subheader-icon fal fa-users'></i> 
                                        Информация для зарегистрированных пользователей   
                                        </h6>
                                        <a href="/book-of-friends-php-component/app/views/login" class="btn-link text-white ml-auto ml-sm-0">
                                        Войти
                                        </a>
                                        <div class="blankpage-footer text-center">
                                        Нет аккаунта? <a href="/book-of-friends-php-component/register"><strong>Зарегистрироваться</strong>
                                        </div>
                                        </div> 
                            <?php endif;?>  
                            </div> 
                        </div>                   
                    </div>
                </div>
            </div>

<?php endforeach;?>

<div class="row" ">
    <div class="col-xl-4">
        <div class="card border shadow-0 mb-g shadow-sm-hover" >
            <div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
                            
            
            <ul class="pagination">
            <?php if ($paginator->getPrevUrl()): ?>
                <li class="page-item"><a class="page-link" href="<?php echo $paginator->getPrevUrl(); ?>">Previous</a></li>
                <?php endif; ?>

                <?php foreach ($paginator->getPages() as $page): ?>
                    <?php if ($page['url']): ?>
                    <li class="page-item" <?php echo $page['isCurrent'] ? 'class="active"' : ''; ?>><a class="page-link" href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a></li>
                    <?php else: ?>
                <li class="page-item"><a class="page-link" href="#" class="disabled"><?php echo $page['num']; ?></a></li>
                <?php endif; ?>
                <?php endforeach; ?>
                
                
                <?php if ($paginator->getNextUrl()): ?>
                <li class="page-item"><a class="page-link" href="<?php echo $paginator->getNextUrl(); ?>">Next</a></li>
                <?php endif; ?>
            </ul>


            </div>
        </div>
    </div>
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
