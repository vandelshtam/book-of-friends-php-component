<?php $this->layout('layout', ['title' => 'Media']); ?>
<!DOCTYPE html>
<html lang="en">

    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-image'></i> Загрузить аватар
            </h1>

        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
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
                                    <label class="form-label" for="example-fileinput">Выберите аватар</label>
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