<?php
/**
 * Created by PhpStorm.
 * User: franc
 * Date: 7/20/18
 * Time: 10:54 PM
 */

class connect
{
    //connect to database
    public $conn;
    public function __construct()
    {
        $this->conn= new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);

        return $this->conn;
    }

}