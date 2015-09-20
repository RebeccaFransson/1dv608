<?php

namespace model;

class Login {
    private $username = 'Admin';
    private $password = 'Password';
    public $errorMessage = ''; //gör den privat?
    public $saveUsername = false;
    public $isLoggedInLogin = false;

    public function __construct($s){
      $this->Session = $s;
    }
    //Kollar om uppgifterna är korrekta
    public function checkLogin($inputs){
      //tomma?
      //om det finns session sätt till true direkt
        if($this->Session->IsThereSession()){
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
        }

      //gick att logga in
           $this->isLoggedInLogin = true;
           return true;
    }

    public function getErrorMessage(){
      return $this->errorMessage;
    }
    public function getSaveUsername(){
      return $this->saveUsername;
    }
    public function setIsLoggedIn($bool){
      $this->isLoggedInLogin = $bool;
      echo "<br>om utloggad sätt false= "; var_dump($this->isLoggedInLogin);
    }
    public function getIsLoggedIn(){
      //om det är utloggad(hämta från view) sätt till false
      /*var_dump($this->Session->getLoggedOutSession());
      if($this->Session->getLoggedOutSession()){
        echo "<br>ja!! utloggad";
      }*/

      return $this->isLoggedInLogin;
      echo "<br>hämtar utlogg "; var_dump($this->isLoggedInLogin);
    }

}
//Här vill vi kolla om lösenord och användarnamn stämmer med dem vi skcikat med. som return returnar vi om det är rätt eller fel!
