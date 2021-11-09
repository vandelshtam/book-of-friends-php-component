<?php $this->layout('layout', ['title' => 'status']); ?>

    
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-sun'></i> Установить статус
            </h1>

        </div>
        <form action="/status/<?=$id;?>" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel" style="border-radius: 25px; background-color: rgb(220 220 220)" >
                        <div class="panel-container">
                            <br><br>
                            <?php echo flash()->display();?>
                            <div class="panel-hdr" style="background-color: rgb(220 220 220)">
                                <h2>Установка текущего статуса</h2>
                                
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- status -->
                                        <div class="form-group">
                                            <label class="form-label" for="example-select">Выберите статус</label>
                                            
                                            <select class="form-control rounded-plus" id="example-select" name="status">
                                            <?php foreach($list_statuses as $key=>$list_status):;?>
                                                <?php if($key==$statuses['status']){?>
                                                <option class="rounded-plus" selected><?php echo $list_statuses[$key];?></option>
                                                <?php } else{ ?>
                                                    <option><?php echo $list_status;?></option>    
                                                <?php } endforeach; ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button class="btn btn-warning rounded-plus" type="submit">Set Status</button>
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
   