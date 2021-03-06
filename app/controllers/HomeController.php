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
        $userAuthId = $this->auth->getUserId();
        if($userAuthId == false){
            flash()->error('Такого пользователя нет');
                header('Location: /'); 
                die();
        }
        if($this->auth->hasRole(\Delight\Auth\Role::ADMIN) == false && $this->auth->hasRole(\Delight\Auth\Role::DEVELOPER) == false &&   $userAuthId != $id){
            flash()->error('У вас нет прав доступа');
                header('Location: /'); 
                die();
        }
        $user=$this->qb->getUser($id,'users');
        echo $this->templates->render('page_profile', ['name'=>'Page profile', 'user' => $user, 'ses'=>\Delight\Cookie\Session::set('username', $this->auth->getUsername())]);   
    }
    



    public function avatar($vars){
        
        $id = $vars['id'];
        $userAuthId = $this->auth->getUserId();
        if($userAuthId == false){
            flash()->error('Такого пользователя нет');
                header('Location: /'); 
                die();
        }
        if($this->auth->hasRole(\Delight\Auth\Role::ADMIN) == false && $this->auth->hasRole(\Delight\Auth\Role::DEVELOPER) == false &&   $userAuthId != $id){
            flash()->error('У вас нет прав доступа');
                header('Location: /'); 
                die();
        }
        $direct='/Applications/MAMP/htdocs/book-of-friends-php-component/public/uploads/';
        
        if(isset($_POST['send_update'])){
            $image_name=$_FILES['avatar']['name'];
            $image_name_tmp=$_FILES['avatar']['tmp_name'];
            $new_avatar='book_'.$image_name;
            $data = ['avatar' => $new_avatar];

            $this->mb->deleteFileAvatar($id);
            $this->mb->loadingFileAvatar($image_name_tmp,$direct,$new_avatar);
            $this->mb->updateAvatar($data,$id,'users');
            flash()->success('Вы успешно обновили свой аватар');
        }
        elseif(isset($_POST['send_delete'])){
            $this->mb->deleteFileAvatar($id);
            $data = ['avatar' => 'avatar-m.png'];
            $this->mb->updateAvatar($data,$id,'users');
            flash()->warning('Вы успешно удалили свой аватар');
        }
            $avatar=$this->mb->getAvatar($id,'users');
            $current_avatar=$this->mb->hisAvatar($id,'users');
            echo $this->templates->render('media', ['name'=>'media', 'avatar' => $avatar, 'current_avatar' => $current_avatar, 'id' => $id]);
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




    public function statusShow($vars){
        $id = $vars['id'];
        $statuses=$this->qb->getUser($id,'users');  
        $list_statuses=[0 => 'online', 1 => 'walked away', 2 => 'do not disturb'];
            
        echo $this->templates->render('status', ['name'=>'status', 'statuses'=> $statuses, 'list_statuses' => $list_statuses, 'id' => $id]);
    } 




    public function status($vars){
        
        $id = $vars['id'];
        $userAuthId = $this->auth->getUserId();
        if($userAuthId == false){
            flash()->error('Такого пользователя нет');
                header('Location: /'); 
                die();
        }
        if($this->auth->hasRole(\Delight\Auth\Role::ADMIN) == false && $this->auth->hasRole(\Delight\Auth\Role::DEVELOPER) == false &&   $userAuthId != $id){
            flash()->error('У вас нет прав доступа');
                header('Location: /'); 
                die();
        }
        $list_statuses_set=[ 'online' => 0,  'walked away' => 1,  'do not disturb' => 2];              
        
            $status_key = $list_statuses_set[$_POST['status']];
            $data = ['status' => $status_key];    
            $this->qb->update($data,$id,'users');
            flash()->success('Вы успешно обновили свой статус');
            header('Location: /');  
            
    } 
    }

    
