<?php
namespace App\model;


use Aura\SqlQuery\QueryFactory;
use Faker\Factory;
use PDO;

class QueryBuilder{
    private $pdo;
    private $queryFactory;

    public function __construct(PDO $pdo, QueryFactory $queryFactory)
    {
        $this->pdo = $pdo;
        $this->queryFactory = $queryFactory;
        
    }
    public function getAll($table){
        
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
        ->from($table);
        
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $result = $sth->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    }
    public function insert($data,$table){
        $insert = $this->queryFactory->newInsert();
        $insert
            ->into($table)                   
            ->cols($data);

        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());   
    }

    public function update($data,$id,$table){

        $update = $this->queryFactory->newUpdate();
        $update
            ->table($table)                  
            ->cols($data)
            
            ->where('id = :id')
            ->bindValue('id', $id);
        
        $sth = $this->pdo->prepare($update->getStatement());   
        $sth->execute($update->getBindValues());    
    }

    public function delete($id,$table){
        $delete = $this->queryFactory->newDelete();
        $delete
            ->from($table)                   
            ->where('id = :id')          
            ->bindValue('id', $id);

        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());    
    }

    public function getUser($id,$table){
        $select=$this->queryFactory->newSelect();
            $select
            ->cols(['*'])
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());           
        $user=$sth->fetch(PDO::FETCH_ASSOC);
        return $user;
    }


    public function rowsCount($table, $field = 'id')
    {
        $select = $this->queryFactory->newSelect();
        $column = "COUNT({$field})";

        $select
            ->cols([$column])
            ->from($table);
        
        $statement = $this->pdo->prepare($select->getStatement());
        $statement->execute($select->getBindValues());

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
 
        return intval($result[0][$column]);
    }

    public function get_3_users($table){
        $select=$this->queryFactory->newSelect();
                $select
                ->cols(['*'])
                ->from($table)
                ->setPaging(3)
                ->page($_GET['page'] ?? 1);
                $sth = $this->pdo->prepare($select->getStatement());
                $sth->execute($select->getBindValues());
                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $result;
    }
        
    

}