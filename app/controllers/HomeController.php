<?php

namespace App\controllers;

use PDO;
use Delight\Auth\Auth;
use \DI\ContainerBuilder;
use League\Plates\Engine;
use JasonGrimes\Paginator;
use App\model\MediaBuilder;
use App\model\QueryBuilder;
use Tamtamchik\SimpleFlash\Flash;

class HomeController{

    private $templates;
    private $auth;
    public $flash;
    private $qb;
    private $mb;
    
    

    public function __construct(
        Engine $engine, 
        Auth $auth, 
        Flash $flash, 
        QueryBuilder $qb,
        MediaBuilder $mb )
    {
        $this->auth = $auth;
        $this->templates = $engine;
        $this->flash = $flash;
        $this->qb = $qb;
        $this->mb = $mb;
    }
    public function home(){
        $users=$this->qb->getAll('users'); 
        echo $this->templates->render('homepage', ['name'=>'All users', 'users' => $users]);   
    }

    public function about(){ 
        echo $this->templates->render('about', ['name'=>'About']);   
    }

    public function page_profile($vars){
        
        $id = $vars['id'];
        $user=$this->qb->getUser($id,'users');
        echo $this->templates->render('page_profile', ['name'=>'Page profile', 'user' => $user, 'ses'=>\Delight\Cookie\Session::set('username', $this->auth->getUsername())]);   
    }
    
    public function avatar($vars){
        
        $id = $vars['id'];
        $direct='/Applications/MAMP/htdocs/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/';
        
        if(isset($_POST['send_update'])){
            $image_name=$_FILES['avatar']['name'];
            $image_name_tmp=$_FILES['avatar']['tmp_name'];
            $new_avatar='/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/'.$image_name;
            $data = ['avatar' => $new_avatar];

            $this->mb->deleteFileAvatar($id);
            $this->mb->loadingFileAvatar($image_name_tmp,$direct,$image_name);
            $this->mb->updateAvatar($data,$id,'users');
            
        }
        elseif(isset($_POST['send_delete'])){
            $this->mb->deleteFileAvatar($id);
            $data = ['avatar' => '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/plane_demo.png'];
            $this->mb->updateAvatar($data,$id,'users');
            
        }
            $avatar=$this->mb->getAvatar($id,'users');
            $current_avatar=$this->mb->hisAvatar($id,'users');
            echo $this->templates->render('media', ['name'=>'media', 'avatar' => $avatar, 'current_avatar' => $current_avatar]);
    }

    public function paginator(){
   
        $totalUsers = $this->qb->rowsCount('users');
        $users = $this->qb->get_3_users('users');
        
        $itemsPerPage = 3;
        $currentPage = $_GET['page'] ?? 1;
        $urlPattern = '?page=(:num)';
        $paginator = new Paginator($totalUsers, $itemsPerPage, $currentPage, $urlPattern);
        
        echo $this->templates->render('paginator', 
        ['name'=>'User Paginator', 'totalUsers'=>$totalUsers, 
         'itemsPerPage'=>$itemsPerPage,
         'users' => $users,
         'currentPage'=>$currentPage,
         'urlPattern'=>$urlPattern,
         'paginator' => $paginator]);
    }

    public function status($vars){
        $id = $vars['id'];
        $list_statuses=[0 => 'online', 1 => 'walked away', 2 => 'do not disturb'];
        $list_statuses_set=[ 'online' => 0,  'walked away' => 1,  'do not disturb' => 2];
        $status_key = $list_statuses_set[$_POST['status']];
        $data = ['status' => $status_key];
                      
        if(isset($_POST['status'])){
                
            $this->qb->update($data,$id,'users');
            flash()->success('Вы успешно обновили свой статус');    
        }
        $statuses=$this->qb->getUser($id,'users');       
        echo $this->templates->render('status', ['name'=>'status', 'statuses'=> $statuses, 'list_statuses' => $list_statuses]);
    } 
    }

    
