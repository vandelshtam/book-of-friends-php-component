<?php $this->layout('layout', ['title' => 'status']);
$pdo = new PDO("mysql:host=localhost:8889; dbname=app3; charset=utf8;","root","root");
$auth = new \Delight\Auth\Auth($pdo);
?>
<!DOCTYPE html>
<html lang="en">

    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-sun'></i> Установить роль пользователя
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
                                                                    <a class="dropdown-item" href="/">
                                                                        <i class="fa fa-edit"></i>
                                                                        Перейти на главную</a> 
                                                                    <a class="dropdown-item" href="/page_profile/<?=$id;?>">
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
        <form action="" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel" style="border-radius: 25px; background-color: rgb(220 220 220)">
                        <div class="panel-container">
                            <?php echo flash()->display();?>
                            <div class="panel-hdr" style="border-radius: 25px; background-color: rgb(220 220 220)">
                                <h2>Текущая роль пользователя:  
                                <?php foreach($role_mask as $mask):;?>
                                        <?php echo $mask;?><tr>,  </tr>
                                        <?php  endforeach; ?>
                                </h2>
                                
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- status -->
                                        <div class="form-group">
                                            <label class="form-label" for="example-select">Выберите роль</label>
                                            
                                            <select class="form-control" id="example-select" name="role" style="border-radius: 10px;">
                                            <?php foreach($role_statuses as $role_status):;?>
                                                    <option><?php echo $role_status;?></option>    
                                                <?php endforeach; ?>                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button class="btn btn-warning" style="border-radius: 10px;" type="submit">Set Role</button>
                                    </div>
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
    
