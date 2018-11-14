<?php
class DataBase {
    /*
    const host = '127.0.0.1';
    const name = 'commitete_db';
    const login = 'mailer';
    const password = '1024';
    */
    const host = '127.0.0.1';
    const name = 'commitete_db';
    const login = 'root';
    const password = '';

    protected $DBH;
    protected $STH;

    public function __construct() {
        try {
            $this->DBH = new PDO('mysql:host='.self::host.';dbname='.self::name.';charset=UTF8', self::login, self::password);
        }catch(PDOException $e){
            print $e->getMessage();
        }
    }
}