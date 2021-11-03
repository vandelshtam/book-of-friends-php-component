<?php
namespace App\model;


use Aura\SqlQuery\QueryFactory;
use Faker\Factory;
use PDO;
use App\model\QueryBuilder;

class MediaBuilder{
    private $pdo;
    private $queryFactory;
    private $qb;
    

    public function __construct(PDO $pdo, QueryFactory $queryFactory, QueryBuilder $qb)
    {
        $this->pdo = $pdo;
        $this->queryFactory = $queryFactory;
        $this->qb = $qb;
    }

    
    public function loadingFileAvatar($image_name_tmp,$direct,$image_name){
        is_uploaded_file($image_name_tmp);
        move_uploaded_file($image_name_tmp, $direct.$image_name );
    }

    public function hisAvatar($id, $table){
        
        if(!empty($this->qb->getUser($id,$table)))
        {
            return true; 
        }
        else
        {
            return false;
        }    
    }
        
    public function deleteFileAvatar($id){
          
        $user=$this->qb->getUser($id,'users');
        if($user['avatar']!=null and $user['avatar'] != '/php/lessons_php/module_2/module_2_training_project/app/views/img/demo/avatars/plane_demo.png')
        {
            unlink('/Applications/MAMP/htdocs'.$user['avatar']);
        }    
    }

    public function updateAvatar($data, $id, $table){
        $this->qb->update($data,$id,$table);   
    }

    public function getAvatar($id,$table){
        $user_avatar=$this->qb->getUser($id,$table);
        $avatar = $user_avatar['avatar'];
        return $avatar;

    }





    
    
    

    
}