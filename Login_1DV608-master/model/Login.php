<?php

namespace model;

class Login {
    private $username = 'Admin';
    private $password = 'Password';
    public $errorMessage = 'hejsan'; //gör den privat?

    public function __construct(){

    }

    public function checkLogin($inputs){
           if(empty($inputs["username"])){
             $this->errorMessage = 'Username is missing';
             var_dump($this->errorMessage);
             return false;
           }
           if(empty($inputs["password"])){
             $this->errorMessage = 'Password is missing';
             return false;
           }
    }

    public function getErrorMessage(){
      echo "get: $this->errorMessage"; //får itne tag på message i denna funktionen
      return $this->errorMessage;
    }
}
//Här vill vi kolla om lösenord och användarnamn stämmer med dem vi skcikat med. som return returnar vi om det är rätt eller fel!
