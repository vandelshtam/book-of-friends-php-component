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

class UserController{

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
    
    public function register(){
        
        echo $this->templates->render('register', ['name' => 'Register user!']);
        
        if(isset($_POST)){

        try {
            $userId = $this->auth->register($_POST['email'],$_POST['password'],$_POST['username'], function ($selector, $token) {
            echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)';
            });
            flash()->success('Вы успешно зарегистрировались, не забудьте пройти  верификацию.');
            flash()->info('We have signed up a new user with the ID ' . $userId);
            
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error('Invalid email address');
            die();
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error('Invalid password');
            die();
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error('User already exists');
            die();
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error('Too many requests');
            die();
        }
        }    
    }

    public function email_verification(){
       
        echo $this->templates->render('email_varification', ['name' => 'User email verification!']);

        if(isset($_POST)){
            try {
            $this->auth->confirmEmail($_POST['code'], $_POST['tokin']);
            flash()->error('Email address has been verified');
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            flash()->error('Invalid token');
            die();
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            flash()->error('Token expired');

            die();
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error('Email address already exists');

            die();
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error('Too many requests');

            die();
        }
        }    
    }

     public function login(){
        
        if (isset($_POST['rememberme']) == 'on') {
            // keep logged in for one year
            $rememberDuration = (int) (60 * 60 * 24 * 365.25);
        }
        else {
            // do not keep logged in after session ends
            $rememberDuration = null;
        }

        if(isset($_POST['login'])){
        try {
                $this->auth->login($_POST['email'], $_POST['password'], $rememberDuration);
                flash()->success('User is logged in');
                header('Location: /php/lessons_php/module_2/module_2_training_project/public/index.php/home'); 
            }
            catch (\Delight\Auth\InvalidEmailException $e) {
                flash()->warning('Wrong email address');
                //die();
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {
                flash()->warning('Wrong password');
                //die();
            }
            catch (\Delight\Auth\EmailNotVerifiedException $e) {
                flash()->error('Email not verified');
                //die();
            }
            catch (\Delight\Auth\TooManyRequestsException $e) {
                flash()->error('Too many requests');
                //die();
            }     
        }
        echo $this->templates->render('login', ['name' => 'User login!']); 
    }

    public function edit($vars){
        
        $id = $vars['id'];
        $list_statuses=[0 => 'online', 1 => 'walked away', 2 => 'do not disturb'];
        $list_statuses_set=[ 'online' => 0,  'walked away' => 1,  'do not disturb' => 2];

        if(isset($_POST['send'])){
            
            $data = [                    
                'username' => $_POST['username'],
                'city' => $_POST['city'],
                'phone' => $_POST['phone'],
                'occupation' => $_POST['occupation'],
                'vk' => $_POST['vk'],
                'telegram' => $_POST['telegram'],
                'instagram' => $_POST['instagram']
            ];

            $list_statuses=[0 => 'online', 1 => 'walked away', 2 => 'do not disturb'];
            $list_statuses_set=[ 'online' => 0,  'walked away' => 1,  'do not disturb' => 2];
            $status_key = $list_statuses_set[$_POST['status']];
            $data = ['status' => $status_key];
            $this->qb->update($data,$id,'users');
            $user=$this->qb->getUser($id,'users');
        
            flash()->success('Вы успешно обновили профиль');    
        }
            $user=$this->qb->getUser($id,'users');
            echo $this->templates->render('edit', ['name'=>'Edit profile', 'list_statuses' => $list_statuses, 'user' => $user ]);    
    }

    public function addUser(){

        $list_statuses_set=[ 'online' => 0,  'walked away' => 1,  'do not disturb' => 2];

        if(isset($_POST['username']) AND isset($_POST['email']) AND isset($_POST['password'])){

            try {
                $userId = $this->auth->admin()->createUser($_POST['email'], $_POST['password'], $_POST['username']);
                flash()->asuccess('We have signed up a new user with the ID ' . $userId);
                
            }
            catch (\Delight\Auth\InvalidEmailException $e) {
                flash()->danger('Invalid email address');
                die('Invalid email address');
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {
                flash()->warning('Invalid password');
                die('Invalid password');
            }
            catch (\Delight\Auth\UserAlreadyExistsException $e) {
                flash()->error('User already exists');
                die('User already exists');
            }

            $status_key = $list_statuses_set[$_POST['status']];
            $data = [ 
                'status' => $status_key,
                'city' => $_POST['city'],
                'vk' => $_POST['vk'],
                'phone' => $_POST['phone'],
                'telegram' => $_POST['telegram'],
                'instagram' => $_POST['instagram'],
                'occupation' => $_POST['occupation']   
            ];
            
        $this->qb->update($data, $userId,'users');

            $direct='/Applications/MAMP/htdocs/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/';
        
            $image_name=$_FILES['avatar']['name'];
            $image_name_tmp=$_FILES['avatar']['tmp_name'];
            $new_avatar='/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/'.$image_name;
            $data = ['avatar' => $new_avatar];

            $this->mb->deleteFileAvatar($userId);
            $this->mb->loadingFileAvatar($image_name_tmp,$direct,$image_name);
            $this->mb->updateAvatar($data,$userId,'users');
            
            flash()->success('Вы успешно добавили пользователя. Добавить еще одного пользователя?');
        }
        else{
            flash()->info('Вы еще не добавили нового пользователя');   
        }
        echo $this->templates->render('addUser', ['name'=>'Add User', ]);   
    }

    public function roles($vars){
        $id = $vars['id'];
        $role_mask=$this->auth->admin()->getRolesForUserById($id);
        $role_statuses = ['ADMIN' ,'DEVELOPER' , 'revoke the administrator role', 'revoke the developer role', 'MODERATOR', 'revoke the moderator role', 'SUPER_ADMIN','revoke the super_admin role'];
                     
        if(isset($_POST['role'])){
            if($_POST['role']=="ADMIN"){
                $this->auth->admin()->addRoleForUserById($id, \Delight\Auth\Role::ADMIN);
            }
            if($_POST['role']=="DEVELOPER"){
                $this->auth->admin()->addRoleForUserById($id, \Delight\Auth\Role::DEVELOPER);
            }
            if($_POST['role']=="MODERATOR"){
                $this->auth->admin()->addRoleForUserById($id, \Delight\Auth\Role::MODERATOR);
            }
            if($_POST['role']=="SUPER_ADMIN"){
                $this->auth->admin()->addRoleForUserById($id, \Delight\Auth\Role::SUPER_ADMIN);
            }
            if($_POST['role']=='revoke the administrator role'){
                $this->auth->admin()->removeRoleForUserById($id, \Delight\Auth\Role::ADMIN);
            }
            if($_POST['role']=='revoke the developer role'){
                $this->auth->admin()->removeRoleForUserById($id, \Delight\Auth\Role::DEVELOPER);
            }
            if($_POST['role']=='revoke the moderator role'){
                $this->auth->admin()->removeRoleForUserById($id, \Delight\Auth\Role::MODERATOR);
            }
            if($_POST['role']=='revoke the super_admin role'){
                $this->auth->admin()->removeRoleForUserById($id, \Delight\Auth\Role::SUPER_ADMIN);
            }
            flash()->success('Вы успешно имзменили роль пользователя');        
        }
        $role_mask=$this->auth->admin()->getRolesForUserById($id);
        echo $this->templates->render('roles', ['name'=>'roles',  'role_statuses' => $role_statuses,  'role_mask' => $role_mask]);
    }

    public function delete($vars){
        $id = $vars['id'];
        if($this->auth->hasRole(\Delight\Auth\Role::ADMIN) OR $_SESSION['confirm'] == true  OR $this->auth->hasRole(\Delight\Auth\Role::DEVELOPER)){
            $_SESSION['confirm_password'] = null;
            if(isset($_POST['delete_user'])){
                $this->mb->deleteFileAvatar($id);
                try {
                $this->auth->admin()->deleteUserById($id);
                flash()->success('Вы успешно удалили пользователя');
                header('Location: /php/lessons_php/module_2/module_2_training_project/public/index.php/home'); 
                die();
                }
                catch (\Delight\Auth\UnknownIdException $e) {
                flash()->success('Unknown ID'); 
                }
                }
            flash()->success('Вы действительно хотите пользователя?');
            $user=$this->qb->getUser($id,'users');
            echo $this->templates->render('delete', ['name'=>'delete', 'user' => $user]); 
        }
        else{
            header('Location: /php/lessons_php/module_2/module_2_training_project/public/index.php/confirm_password/'.$id); die;
        }
        
    }
    
    public function confirm_password($vars){
        $id = $vars['id'];
        if(isset($_POST['c_password'])){
            try {
                    if ($this->auth->reconfirmPassword($_POST['c_password'])) {
                        flash()->info('The user really seems to be who they claim to be');
                        $_SESSION['confirm_password'] = true;
                        header_remove("Location"); 
                        header('Location: /php/lessons_php/module_2/module_2_training_project/public/index.php/delete/'.$id);
                    }
                    else {
                        flash()->warning('We can\'t say if the user is who they claim to be');     
                    }
            }
            catch (\Delight\Auth\NotLoggedInException $e) {
                flash()->error('The user is not signed in');  
            }
            catch (\Delight\Auth\TooManyRequestsException $e) {
                flash()->error('Too many requests');  
            }
        } 
        echo $this->templates->render('confirm_password', ['name'=>'confirm_password']);  
}    
    
    
    public function security_admin(){

        if(isset($_POST['username']) AND isset($_POST['newPassword'])){
            try {
            $this->auth->admin()->changePasswordForUserByUsername($_POST['username'], $_POST['newPassword']);
            flash()->success('Вы успешно изменили пароль пользователя');
            header('Location: /php/lessons_php/module_2/module_2_training_project/public/index.php/home'); 
        }
        catch (\Delight\Auth\UnknownUsernameException $e) {
            flash()->error('Unknown username');    
        }
        catch (\Delight\Auth\AmbiguousUsernameException $e) {
            flash()->error('Ambiguous username');    
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error('Invalid password');   
        }
        }
        echo $this->templates->render('security_admin', ['name'=>'security_admin']);
    }

    public function logout(){
        $this->auth->logOut();
        $this->auth->destroySession();
        flash()->success('Вы успешно вышли из своего аккаунта');
        header('Location: /php/lessons_php/module_2/module_2_training_project/public/index.php/home');
    }
    }

    
