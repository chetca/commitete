<?php
require_once('Database.php');

class Reception extends DataBase {
    
    private $table = 'reception';

    public $id;
    public $time_id;
    public $date;
    public $status_id;
    public $operator_id;
    public $user_id;
    public $operatorPlan;
    public $record;


    public function __construct() {
        parent::__construct();
    }

    public function findOne($id = ''){
        $id = $id == '' ? $this->id : $id;
        try{
            $this->STH = $this->DBH->prepare("SELECT * FROM `".$this->table."` WHERE  id=:id");
            $this->STH->bindParam(':id', $id, PDO::PARAM_INT);
            $this->STH->execute();
            return $this->STH->fetch();
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

	public function selectReception()
	{
        try{
            $this->STH = $this->DBH->prepare("SELECT * FROM `".$this->table."`");
            $this->STH->execute();
            return $this->STH->fetchAll();
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
	}

    public function selectReceptionUser($date)
    {
        $status = 2;
        try{
            $this->STH = $this->DBH->prepare("SELECT * FROM `".$this->table."` WHERE status_id=:status AND date=:date");
            $this->STH->bindParam(':status', $status, PDO::PARAM_INT);
            $this->STH->bindParam(':date', $date);
            $this->STH->execute();
            return $this->STH->fetchAll();
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}

