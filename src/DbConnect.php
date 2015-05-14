<?php
 include_once 'config.php';
class DbConnect {
 
    private $conn;
 
    function __construct() {        
    }
 
    /**
     * Establishing database connection
     * @return database connection handler
     */
    function getConnection() {
       
      $dbhost=DB_HOST;
      $dbuser=DB_USERNAME;
      $dbpass=DB_PASSWORD;
      $dbname=DB_NAME;

 
       $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
       $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       return $dbh;
    }
 
}
?>