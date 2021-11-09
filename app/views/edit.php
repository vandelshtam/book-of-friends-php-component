<?php $this->layout('layout', ['title' => 'Edit profile']);
$pdo = new PDO("mysql:host=localhost:8889; dbname=app3; charset=utf8;","root","root");
$auth = new \Delight\Auth\Auth($pdo);
?>
<br>
<br>
    <main id="js-page-content" role="main" class="page-content mt-6">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> Редактировать
            </h1>
        </div>
        <br><br>
        <strong class="rounded-plus"><?php echo flash()->display();?></strong> 
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
                <div class="col-xl-6" >
                    <div id="panel-1" class="panel" style="border-radius: 25px; background-color: rgb(220 220 220)">
                        <div class="panel-container">    
                        <div class="panel-hdr" style="border-radius: 25px; background-color: rgb(220 220 220)">
                                <h2>Общая информация</h2>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Имя</label>
                                    <input type="text" id="simpleinput" class="form-control rounded-plus"  name="username" value="<?=$user['username'];?>">
                                </div>
                                
                                <!-- title -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Место работы</label>
                                    <input type="text" id="simpleinput" class="form-control rounded-plus"  name="occupation" value="<?=$user['occupation'];?>">
                                </div>

                                <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Номер телефона</label>
                                    <input type="text" id="simpleinput" class="form-control rounded-plus"  name="phone" value="<?=$user['phone'];?>">
                                </div>

                                <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">City</label>
                                    <input type="text" id="simpleinput" class="form-control rounded-plus"  name="city" value="<?=$user['city'];?>">
                                </div>
                                <div class="form-group">
                                            <label class="form-label" for="example-select">Выберите статус</label>
                                            
                                            <select class="form-control rounded-plus" id="example-select" name="status">
                                            <?php foreach($list_statuses as $key=>$list_status):;?>
                                                <?php if($key==$user['status']){?>
                                                <option selected><?php echo $list_statuses[$key];?></option>
                                                <?php } else{ ?>
                                                    <option><?php echo $list_status;?></option>    
                                                <?php } endforeach; ?>
                                                
                                            </select>
                                        </div>
                    <div class="col-xl-12">
                    <div id="panel-1" class="panel" style="border-radius: 15px;">                
                        <div class="panel-container">            
                            <div class="panel-hdr" style="border-radius: 15px;">
                                <h2>Социальные сети</h2>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- vk -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3" style="border-radius: 10px 0px 0px 10px;">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#4680C2"></i>
                                                        <i class="fab fa-vk icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control border-left-0 bg-transparent pl-0" style="border-radius: 0px 10px 10px 0px;"  name="vk" value="<?=$user['vk'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- telegram -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3" style="border-radius: 10px 0px 0px 10px;">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#38A1F3"></i>
                                                        <i class="fab fa-telegram icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control border-left-0 bg-transparent pl-0" style="border-radius: 0px 10px 10px 0px;" name="telegram" value="<?=$user['telegram'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- instagram -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3" style="border-radius: 10px 0px 0px 10px;">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#E1306C"></i>
                                                        <i class="fab fa-instagram icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control border-left-0 bg-transparent pl-0" style="border-radius: 0px 10px 10px 0px;" name="instagram" value="<?=$user['instagram'];?>">
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning rounded-plus"  name="send">Редактировать</button>
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
    