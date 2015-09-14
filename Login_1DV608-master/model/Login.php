<?php

namespace model;

class Login {
    private $username = 'Admin';
    private $password = 'Password';
    public $errorMessage = ''; //gör den privat?
    public $saveUsername = false;
    public $isLoggedIn = false;

    public function __construct(){

    }

    //Kollar om uppgifterna är korrekta
    public function checkLogin($inputs){
      //tomma?
           if(empty($inputs["username"])){
             $this->errorMessage = 'Username is missing';
             return false;
           }
           if(empty($inputs["password"])){
             $this->errorMessage = 'Password is missing';
             $this->saveUsername = true;
             return false;
           }
      //fel användarnamn ELLER lösenord
           if($inputs["username"] !== $this->username || $inputs["password"] !== $this->password){
             $this->errorMessage = 'Wrong name or password';
             $this->saveUsername = true;
             return false;
           }
           $this->isLoggedIn = true;
           return true;
    }

    public function getErrorMessage(){
      return $this->errorMessage;
    }
    public function getSaveUsername(){
      return $this->saveUsername;
    }
    public function getIsLoggedIn(){
      return $this->isLoggedIn;
    }
}
//Här vill vi kolla om lösenord och användarnamn stämmer med dem vi skcikat med. som return returnar vi om det är rätt eller fel!
