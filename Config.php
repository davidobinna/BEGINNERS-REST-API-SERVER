<?php

class Config 
{    //
     private const DBHOST = 'localhost' ;
     private const DBUSER = 'root' ;
     private const DBPASS = 'cc!!!R9e[o#' ;
     private const DBNAME = 'restful';

     private $dsn = 'mysql:host='.self::DBHOST.';dbname='.self::DBNAME.';charset=UTF8';
        //
    protected $conn = null ;

    public function __construct() 
    { 
        try {
            $this->conn = new PDO($this->dsn,self::DBUSER,self::DBPASS);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (\PDOException $th) {
            //throw $th;
            die('Connection Failed :'.$e->getMessage());
        }
        return $this->conn;
    }

    //sanitize any inputs before entering the database table
      public function test_input($data)
    {
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data ;
    }

    //Json  format Converter function 
    public function message($content, $status)
    {
        $data = [
            'message' => $content,
            'error' => $status
        ];
        return json_encode($data);
    }
}

?>