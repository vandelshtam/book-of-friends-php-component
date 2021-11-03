<?php
namespace App\views;
echo "HomeController";

use \DI\ContainerBuilder;
use League\Plates\Engine;



class HomeController{

    private $templates;
    
    
    
    
    

    public function __construct(Engine $engine)
    {
        
        $this->templates = $engine;
        

        
    }
    public function home(){
        
        
        
        
        echo $this->templates->render('homepage', ['name'=>'Users', 'users' => $users]);
        
    }
    
    
}
