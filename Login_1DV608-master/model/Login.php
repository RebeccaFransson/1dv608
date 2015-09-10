<?php

namespace model;

class Login {
    private $username = 'Admin';
    private $password = 'Password';
    public $errorMessage = ''; //gör den privat?
    public $saveUsername = false;

    public function __construct(){

    }

    public function checkLogin($inputs){
      //tomma?
           if(empty($inputs["username"])){
             $this->errorMessage = 'Username is missing';
             return false;
           }
           if(empty($inputs["password"])){
             $this->errorMessage = 'Password is missing';
             return false;
           }
      //wrong username OR password
           if($inputs["username"] !== $this->username || $inputs["password"] !== $this->password){
             $this->errorMessage = 'Wrong name or password';
             $this->saveUsername = true;
             //spara username
           }
    }

    public function getErrorMessage(){
      return $this->errorMessage;
    }
    public function getSaveUsername(){
      return $this->saveUsername;
    }
}
//Här vill vi kolla om lösenord och användarnamn stämmer med dem vi skcikat med. som return returnar vi om det är rätt eller fel!
