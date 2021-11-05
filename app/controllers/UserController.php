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
        
        if(!empty($_POST)){

        try {
            $userId = $this->auth->register($_POST['email'],$_POST['password'],$_POST['username'], function ($selector, $token) {
            echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)';
            });
            $data_user = [ 
                'c' => 'c_'.$userId,
                'search' => strtolower($_POST['username'])    
                ];
                $this->qb->update($data_user, $userId,'users');
            flash()->success('Вы успешно зарегистрировались, не забудьте пройти  верификацию.');
            header('Location: /book-of-friends-php-component/login');        
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error('Invalid email address');
            header('Location: /book-of-friends-php-component/register');  
            die();
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error('Invalid password');
            header('Location: /book-of-friends-php-component/register'); 
            die();
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error('User already exists');
            header('Location: /book-of-friends-php-component/register'); 
            die();
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error('Too many requests');
            header('Location: /book-of-friends-php-component/register'); 
            die();
        }
        }
        
        echo $this->templates->render('register', ['name' => 'Register user!']);    
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
                header('Location: /book-of-friends-php-component/home'); 
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

        if(($_POST['send']) !=null){
            
            $data_user = [                    
                'username' => $_POST['username'],
                'city' => $_POST['city'],
                'phone' => $_POST['phone'],
                'occupation' => $_POST['occupation'],
                'vk' => $_POST['vk'],
                'telegram' => $_POST['telegram'],
                'instagram' => $_POST['instagram'],
                'search' => strtolower($_POST['username']) 
            ];
            $this->qb->update($data_user,$id,'users');
            $list_statuses=[0 => 'online', 1 => 'walked away', 2 => 'do not disturb'];
            $list_statuses_set=[ 'online' => 0,  'walked away' => 1,  'do not disturb' => 2];
            $status_key = $list_statuses_set[$_POST['status']];
            $data_status = ['status' => $status_key];
            $this->qb->update($data_status,$id,'users');
            $user=$this->qb->getUser($id,'users');
            flash()->success('Вы успешно обновили профиль'); 
            header('Location: /book-of-friends-php-component/home');     
        }
        if(!empty($_POST)){
            flash()->info('Вы не внесли изменений,если не хотите вносить изменения перейдите на главную страницу.'); 
        }
            $user=$this->qb->getUser($id,'users');
            echo $this->templates->render('edit', ['name'=>'Edit profile', 'list_statuses' => $list_statuses, 'user' => $user ]);    
    }





    public function addUser(){
      
        $list_statuses_set=[ 'online' => 0,  'walked away' => 1,  'do not disturb' => 2];

        if(!empty($_POST['username']) AND isset($_POST['email']) AND !empty($_POST['password'])){

            try {
                $userId = $this->auth->admin()->createUser($_POST['email'], $_POST['password'], $_POST['username']);
                $data_user = [ 
                'c' => 'c_'.$userId,
                'search' => strtolower($_POST['username'])    
                ];
                $this->qb->update($data_user, $userId,'users');
                if(isset($_POST['city']) OR isset($_POST['status']) OR isset($_POST['phone']) OR isset($_POST['occupation']) OR isset($_POST['vk']) OR isset($_POST['instagram']) OR isset($_POST['telegram'])){
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
                    var_dump($userId);
                    $this->qb->update($data, $userId,'users');
                    }
        
                    if(!empty($_FILES['avatar']['name'])){
                        $direct='/Applications/MAMP/htdocs/book-of-friends-php-component/public/uploads/';
                    
                        $image_name=$_FILES['avatar']['name'];
                        $image_name_tmp=$_FILES['avatar']['tmp_name'];
                        $new_avatar='book_'.$image_name;
                        $data = ['avatar' => $new_avatar];
        
                        $this->mb->deleteFileAvatar($userId);
                        $this->mb->loadingFileAvatar($image_name_tmp,$direct,$new_avatar);
                        $this->mb->updateAvatar($data,$userId,'users');
                    }    
                flash()->success('We have signed up a new user with the ID ' . $userId);
                header('Location: /book-of-friends-php-component/home');     
            }
            catch (\Delight\Auth\InvalidEmailException $e) {
                flash()->info('Invalid email address');
                header('Location: /book-of-friends-php-component/addUser'); 
                die('Invalid email address');
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {
                flash()->warning('Invalid password');
                header('Location: /book-of-friends-php-component/addUser'); 
                die('Invalid password');
            }
            catch (\Delight\Auth\UserAlreadyExistsException $e) {
                flash()->error('User already exists');
                header('Location: /book-of-friends-php-component/addUser'); 
                die('User already exists');
            }
        }
        if(isset($_POST['send']) AND ($_POST['username']) == null){
            flash()->info('Вы заполнили не все поля');   
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
                header('Location: /book-of-friends-php-component/home'); 
                die();
                }
                catch (\Delight\Auth\UnknownIdException $e) {
                flash()->success('Unknown ID'); 
                }
                }
            flash()->success('Вы действительно хотите удалить пользователя?');
            $user=$this->qb->getUser($id,'users');
            echo $this->templates->render('delete', ['name'=>'delete', 'user' => $user]); 
        }
        else{
            header('Location: /book-of-friends-php-component/confirm_password/'.$id); die;
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
                        header('Location: /book-of-friends-php-component/delete/'.$id);
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
            header('Location: /book-of-friends-php-component/home'); 
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





    public function security(){

        if(isset($_POST['username']) AND isset($_POST['newPassword'])){
            try {
            $this->auth->admin()->changePasswordForUserByUsername($_POST['username'], $_POST['newPassword']);
            flash()->success('Вы успешно изменили пароль пользователя');
            header('Location: /book-of-friends-php-component/home'); 
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
        echo $this->templates->render('security', ['name'=>'security']);
    }






    public function logout(){
        $this->auth->logOut();
        $this->auth->destroySession();
        flash()->success('Вы успешно вышли из своего аккаунта');
        header('Location: /book-of-friends-php-component/home');
    }
    }

    
