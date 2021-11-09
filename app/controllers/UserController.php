<?php

namespace App\controllers;

use PDO;
use Delight\Auth\Auth;
use \DI\ContainerBuilder;
use League\Plates\Engine;
use JasonGrimes\Paginator;
use App\model\MediaBuilder;
use App\model\QueryBuilder;
use App\model\MailBuilder;
use Tamtamchik\SimpleFlash\Flash;


class UserController{

    private $templates;
    private $auth;
    public $flash;
    private $qb;
    private $mb;
    private $mailb;
    

    public function __construct(
        Engine $engine, 
        Auth $auth, 
        Flash $flash, 
        QueryBuilder $qb,
        MediaBuilder $mb,
        MailBuilder $mailb)
    {
        $this->auth = $auth;
        $this->templates = $engine;
        $this->flash = $flash;
        $this->qb = $qb;
        $this->mb = $mb;
        $this->mailb = $mailb;
    }
    



    public function registerShow(){
        
        echo $this->templates->render('register', ['name' => 'Register user!']);    
    }




    public function register(){
       
        try {
            $userId = $this->auth->register($_POST['email'],$_POST['password'],$_POST['username'], function ($selector, $token) {
            $lastId = $this->qb->lastId();
            flash()->success('Sent to the user by email selector: ' . $selector . ' and token: ' . $token . ' to the user');
            $body_mail = '<b>'.'You have successfully registered, in this email a selector : 
            ' .$selector. ' and a token :  ' .$token. '  are sent to you. Copy them, follow the link and go through verification: localhost:8888/book-of-friends-php-component/verification/'.$lastId. 
            ' This letter is generated automatically, please do not reply to it. Best regards, administration of the "book-of-friends-php-component" site.'.'</b>' ;
            $this->mailb->mail_to($_POST['email'], $_POST['username'], $body_mail );
            });
            $data_user = [ 
                'c' => 'c_'.$userId,
                'search' => strtolower($_POST['username'])    
                ];
            $this->qb->update($data_user, $userId,'users');
            flash()->success('Sent to the user by email selector and token');
            header('Location: /verification/'.$userId); 
            die();
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error('Invalid email address');
            header('Location: /registerShow');  
            die();
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error('Invalid password');
            header('Location: /registerShow'); 
            die();
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error('User already exists');
            header('Location: /registerShow'); 
            die();
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error('Too many requests');
            header('Location: /registerShow'); 
            die();
        }
        echo $this->templates->render('register', ['name' => 'Register user!', 'id' => $userId]);    
    }



    

    public function email_verification($vars){
        $id = $vars['id'];
        if(!empty($_POST)){
            try {
            $this->auth->confirmEmail($_POST['code'], $_POST['tokin']);
            flash()->success('Email address has been verified');
            $user=$this->qb->getUser($id,'users');
            $body_mail = '<b>'.'You have successfully passed the verification, your login is:' .$user['email'].' '.'</b>' ;
            $this->mailb->mail_to($user['email'], $user['username'], $body_mail );
            header('Location: /login');
            die();
        }
        
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            flash()->error('Invalid token');
            header('Location: /verification/'.$id);
            die();
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            flash()->error('Token expired');
            header('Location: /verification/'.$id);
            die();
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error('Email address already exists');
            header('Location: /verification/'.$id);
            die();
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error('Too many requests');
            header('Location: /verification/'.$id);
            die();
        }
        } 
        
        echo $this->templates->render('email_varification', ['name' => 'User email verification!']);
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
                header('Location: /'); 
                die();
            }
           
            catch (\Delight\Auth\InvalidEmailException $e) {
                flash()->warning('Wrong email address');
                header('Location: /login'); 
                die();
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {
                flash()->warning('Wrong password');
                header('Location: /login'); 
                die();
            }
            catch (\Delight\Auth\EmailNotVerifiedException $e) {
                flash()->error('Email not verified');
                header('Location: /login'); 
                die();
            }
            catch (\Delight\Auth\TooManyRequestsException $e) {
                flash()->error('Too many requests');
                header('Location: /login'); 
                die();
            } 
               
        }
        echo $this->templates->render('login', ['name' => 'User login!']); 
    }





    public function edit($vars){
        
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
        
        $list_statuses=[0 => 'online', 1 => 'walked away', 2 => 'do not disturb'];
        $list_statuses_set=[ 'online' => 0,  'walked away' => 1,  'do not disturb' => 2];

        if(!empty($_POST['username']) != null OR !empty($_POST['city']) !=null  OR !empty($_POST['phone']) != null OR !empty($_POST['occupation']) != null OR !empty($_POST['vk']) != null OR !empty($_POST['telegram']) != null OR !empty($_POST['instagram']) != null OR !empty($_POST['status']) != null){
            
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
            header('Location: /'); 
            die();   
        }
        if(empty($_POST['username'])  AND empty($_POST['city'])  AND empty($_POST['phone'])   AND empty($_POST['occupation'])  AND empty($_POST['vk'])   AND empty($_POST['telegram'])   AND empty($_POST['instagram'])   AND empty($_POST['status']) ){
            flash()->info('Вы еще не внесли изменений,если не хотите вносить изменения перейдите на главную страницу.'); 
        }
            $user=$this->qb->getUser($id,'users');
            echo $this->templates->render('edit', ['name'=>'Edit profile', 'list_statuses' => $list_statuses, 'user' => $user, 'id' => $id ]); 
               
    }





    public function addUser(){
      
        if($this->auth->hasRole(\Delight\Auth\Role::ADMIN) == false && $this->auth->hasRole(\Delight\Auth\Role::DEVELOPER) == false){
            flash()->error('У вас нет прав доступа');
                header('Location: /'); 
                die();
        }
        
        $list_statuses_set=[ 'online' => 0,  'walked away' => 1,  'do not disturb' => 2];
        

        if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['password'])){
            $_SESSION['add']['username'] = $_POST['username'];
            $_SESSION['add']['email'] = $_POST['email'];
            $_SESSION['add']['occupation'] = $_POST['occupation'];
            $_SESSION['add']['city'] = $_POST['city'];
            $_SESSION['add']['phone'] = $_POST['phone'];
            $_SESSION['add']['vk'] = $_POST['vk'];
            $_SESSION['add']['telegram'] = $_POST['telegram'];
            $_SESSION['add']['instagram'] = $_POST['instagram'];
            try {
                $userId = $this->auth->admin()->createUser($_POST['email'], $_POST['password'], $_POST['username']);
                $data_user = [ 
                'c' => 'c_'.$userId,
                'search' => strtolower($_POST['username']),
                'verified' => 1      
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
                unset($_SESSION['add']);
                header('Location: /');
                die('');     
            }
            catch (\Delight\Auth\InvalidEmailException $e) {
                flash()->warning('Invalid email address');
                header('Location: /addUser'); 
                die();
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {
                flash()->warning('Invalid password');
                header('Location: /addUser'); 
                die('');
            }
            catch (\Delight\Auth\UserAlreadyExistsException $e) {
                flash()->error('User already exists');
                header('Location: /addUser'); 
                die('');
            }
        }
        if(isset($_POST['send']) AND ($_POST['username']) == null){
            flash()->info('Вы заполнили не все поля');   
        }
        
        echo $this->templates->render('addUser', ['name'=>'Add User', ]);   
    }





    public function roles($vars){
        $id = $vars['id'];
        $user = $this -> qb -> getUser($id, 'users');
        if($user['role'] == 1){
            flash()->error('Вы не можете  изменить роль пользователя обратитесь к разработчикам');
            header('Location: /'); 
            die();
        }
        if($this->auth->hasRole(\Delight\Auth\Role::ADMIN) == false && $this->auth->hasRole(\Delight\Auth\Role::DEVELOPER) == false){
            flash()->error('У вас нет прав доступа');
                header('Location: /'); 
                die();
        }
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
        echo $this->templates->render('roles', ['name'=>'roles',  'role_statuses' => $role_statuses,  'role_mask' => $role_mask, 'id' => $id]);
    }





    public function deleteShow($vars){
        $id = $vars['id'];     
        flash()->warning('Вы действительно хотите удалить пользователя?');
        $user=$this->qb->getUser($id,'users');
        echo $this->templates->render('delete', ['name'=>'delete', 'user' => $user]);     
    }



    public function delete($vars){
        $id = $vars['id'];
        $userAuthId = $this->auth->getUserId();
        $user = $this -> qb -> getUser($id, 'users');
        if($user['roles_mask'] == 1 || $user['roles_mask'] == 262144  || $user['roles_mask'] == 262145){
            flash()->error('Вы не можете удалить пользователя обратитесь к разработчикам');
            header('Location: /'); 
            die();
        }
        if($this->auth->hasRole(\Delight\Auth\Role::ADMIN) == false && $this->auth->hasRole(\Delight\Auth\Role::DEVELOPER) == false  &&   $userAuthId != $id){
            flash()->error('У вас нет прав доступа');
                header('Location: /'); 
                die();
        }
        if($this->auth->hasRole(\Delight\Auth\Role::ADMIN) OR $this->auth->hasRole(\Delight\Auth\Role::DEVELOPER) OR($_SESSION['confirm_password'] == true AND $userAuthId == $id)){      
            try {
            $this->auth->admin()->deleteUserById($id);
            $this->mb->deleteFileAvatar($id);
            flash()->success('Вы успешно удалили пользователя');
            unset($_SESSION['confirm_password']);
                if($this->auth->hasRole(\Delight\Auth\Role::ADMIN)   OR $this->auth->hasRole(\Delight\Auth\Role::DEVELOPER)){
                    header('Location: /'); 
                    die();
                }
                else{
                    header('Location: /logout'); 
                    die();
                }
            }
            catch (\Delight\Auth\UnknownIdException $e) {
            flash()->warning('Unknown ID'); 
            header('Location: /deleteShow/'.$id);
            die();
            }   
        }
        else{
            header('Location: /confirm_password/'.$id); 
            die();
        }
    }
    




    public function confirm_passwordShow($vars){
        $id = $vars['id'];
        echo $this->templates->render('confirm_password', ['name'=>'confirm_password', 'id' => $id]);  
    } 
    
    



    public function confirm_password($vars){
        $id = $vars['id'];
            try {
                    if ($this->auth->reconfirmPassword($_POST['c_password'])) {
                        flash()->info('The user really seems to be who they claim to be');
                        $_SESSION['confirm_password'] = true;
                        header_remove("Location"); 
                        header('Location: /delete/'.$id);
                        die();
                    }
                    else {
                        flash()->warning('We can\'t say if the user is who they claim to be'); 
                        header('Location: /confirm_passwordShow/'.$id);
                        die();    
                    }
            }
            catch (\Delight\Auth\NotLoggedInException $e) {
                flash()->error('The user is not signed in'); 
                header('Location: /confirm_passwordShow/'.$id);
                die();
            }
            catch (\Delight\Auth\TooManyRequestsException $e) {
                flash()->error('Too many requests');
                header('Location: /confirm_passwordShow/'.$id);
                die();  
            }     
    }    
    
    



    public function security_admin(){


        if($this->auth->hasRole(\Delight\Auth\Role::ADMIN) == false && $this->auth->hasRole(\Delight\Auth\Role::DEVELOPER) == false){
            flash()->error('У вас нет прав доступа');
                header('Location: /'); 
                die();
        }

        if(isset($_POST['username']) AND isset($_POST['newPassword'])){
            try {
            $this->auth->admin()->changePasswordForUserByUsername($_POST['username'], $_POST['newPassword']);
            flash()->success('Вы успешно изменили пароль пользователя');
            header('Location: /'); 
            die();
        }
        catch (\Delight\Auth\UnknownUsernameException $e) {
            flash()->error('Unknown username'); 
            header('/Location: security_admin'); 
            die();
        }
        catch (\Delight\Auth\AmbiguousUsernameException $e) {
            flash()->error('Ambiguous username'); 
            header('/Location: security_admin'); 
            die();
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error('Invalid password'); 
            header('/Location: security_admin'); 
            die();
        }
        }
        echo $this->templates->render('security_admin', ['name'=>'security_admin']);
    }





    public function security($vars){
        $id = $vars['id'];
        $userAuthId = $this->auth->getUserId();
        $user = $this->qb->getUser($id,'users');
        if($this->auth->hasRole(\Delight\Auth\Role::ADMIN) == false && $this->auth->hasRole(\Delight\Auth\Role::DEVELOPER) == false &&   $userAuthId != $id){
            flash()->error('У вас нет прав доступа');
                header('Location: /'); 
                die();
        }
        if(isset($_POST['email']) AND isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['confirm'])){
            
            if($user == false){
                flash()->warning('Нет такого пользователя');
                header('Location: /');
                die();
            }
            if($_POST['password'] != $_POST['confirm']){
                flash()->warning('Новый пароль и подтверждение не совпадают');
                header('Location: /security/'.$id);
                die();
            }
            try {
            $this->auth->admin()->changePasswordForUserByUsername($_POST['username'], $_POST['password']);
            flash()->success('Вы успешно изменили данные безопасности пользователя');
            $data_email = ['email' => $_POST['email']];
            $this->qb->update($data_email, $id,'users');
            header('Location: /'); 
            die();
            }
            catch (\Delight\Auth\InvalidEmailException $e) {
                flash()->info('Invalid email address');
                header('Location: /security/'.$id); 
                die('');
            }
            catch (\Delight\Auth\UnknownUsernameException $e) {
                flash()->error('Unknown username'); 
                die('');   
            }
            catch (\Delight\Auth\AmbiguousUsernameException $e) {
                flash()->error('Ambiguous username');  
                die('');  
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {
                flash()->error('Invalid password'); 
                die('');  
            }
        }
        echo $this->templates->render('security', ['name'=>'security', 'user' => $user ]);
    }






    public function logout(){
        $this->auth->logOut();
        $this->auth->destroySession();
        flash()->success('Вы успешно вышли из своего аккаунта');
        header('Location: /');
        die();
    }
    }

    
