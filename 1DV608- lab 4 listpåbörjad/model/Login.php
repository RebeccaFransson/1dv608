<?php
namespace model;
session_start();
class Login {
    private $username = 'Admin';
    private $password = 'Password';
    private $errorMessage = '';
    private $saveUsername = false;
    private $isLoggedInLogin = false;
    private static $loggedInSession = 'Login::loggedIn';
    public function __construct(){
      //för säkerhetenskull se om det finns en session, om inte sätt den så fall till false
      if(!isset($_SESSION[self::$loggedInSession])){
        $_SESSION[self::$loggedInSession] = false;
      }
    }
    //Kollar om uppgifterna är korrekta
    public function checkLogin(Usercredentials $usercredentials, LoginListener $LoginListener){
      //tomma fält
          /*if(empty($inputs["username"])){
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
          }*/

    		if ($usercredentials->getUsername() !== $this->username || $usercredentials->getPassword() !== $this->password){
          //throw new NotCorrectCredentialsException();
          $LoginListener->SetLoginFailed();
        }//finns ej i listan


      //gick att logga in
     //$this->errorMessage = 'Welcome';
     $_SESSION[self::$loggedInSession] = true;
     $LoginListener->SetLoginSuccess();
     return true;
    }
    public function getErrorMessage(){
      return $this->errorMessage;
    }
    public function getSaveUsername(){
      return $this->saveUsername;
    }
    public function loggingOut(){
      //loggar ut, sätter sessionen till false och förstör den
      if(isset($_SESSION[self::$loggedInSession])){
        if($_SESSION[self::$loggedInSession]){
          $_SESSION[self::$loggedInSession] = false;
        }
        $this->errorMessage = 'Bye bye!';
        session_destroy();
      }
    }
    public function getIsLoggedIn(){
      //finns det en sparad session?
      if(isset($_SESSION[self::$loggedInSession])){
        if($_SESSION[self::$loggedInSession]){
          return true;
        }
        return false;
      }
    }
}
