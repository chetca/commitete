<?php
require_once('Database.php');

class Time extends DataBase {
    
    private $table = 'time';

    public $time;


    public function __construct() {
        parent::__construct();
    }

    public function selectTime($id)
    {
        try{
            $this->STH = $this->DBH->prepare("SELECT time FROM `".$this->table."` WHERE id = '".$id."'");
            $this->STH->execute();
            return $this->STH->fetch()['time'];
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}
