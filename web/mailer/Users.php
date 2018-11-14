<?php
require_once('Database.php');
class Users extends DataBase {

    private $table = 'users';

    public $id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $phone;
    public $email;


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

	public function selectAllUsers()
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

    public function selectUser($id)
    {
        try{
            $this->STH = $this->DBH->prepare("SELECT * FROM `".$this->table."` WHERE id = '".$id."'");
            $this->STH->execute();
            return $this->STH->fetch();
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function selectUserEmail($id)
    {
        try{
            $this->STH = $this->DBH->prepare("SELECT email FROM `".$this->table."` WHERE id = '".$id."'");
            $this->STH->execute();
            return $this->STH->fetch()['email'];
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}

