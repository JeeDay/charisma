<?php


class db {
    private $db;
    public $host = 'localhost';
    public $user = 'root';
    public $password = 'mysql';
    public $database = 'charisma';


    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->user, $this->password, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                    )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function getDb(){
        return $this->db;
    }
}
