<?php

namespace model;
class ExistingUserException extends \Exception {};
class UsersDAL{

  private static $table = "Users";
  private static $servername = "localhost";
  private static $usernameDB = "root";
  private static $passwordDB = "";
  private static $nameDB = "UsersLAB4";
  private $conn;
  private $UsersDB = array();

  /*public function __construct(){


  }*/
  // Create connection
  public function connetToDB(){
    $this->conn = new \mysqli(self::$servername, self::$usernameDB, self::$passwordDB, self::$nameDB);
    // Check connection
    if ($this->conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //det all users to new user(array with users from get all usters)
    echo "connected!";

  }
  /*public function getAllUsers(){
      //sql som får alla användare i en lista
      //return userarray;
      $getall = $this->conn->prepare("SELECT * FROM " . self::$table);
  		if ($getall === FALSE) {
  			throw new \Exception($this->conn->error);
  		}
  		$getall->execute();
      $getall->bind_result($username, $password, $id);
var_dump($username);
      while ($getall->fetch()) {
	    	$user = new Users($username, $password);
		}
		return  $this->productCatalog;
  }*/
  public function existingUser($username){
    //sql som lägger till en user i listan
    //return true om den finns
    $getexist = $this->conn->prepare("SELECT EXISTS(SELECT 1 FROM ". self::$table ."WHERE username = " . $username);
    if($getexist === 1){
      echo "finns användare";
      //existing
      throw new ExistingUserException();
    }
    //$getexist->execute();
    echo "finns ingen användare";
  }
  public function addUser(){
    //sql som lägger till en user i listan
  }

}


?>
