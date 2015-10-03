<?php
namespace model;
class NotCorrectCredentialsException extends \Exception {};
class GoodbyeException extends \Exception {};
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

      //ej rätt uppgifter
    		if ($usercredentials->getUsername() !== $this->username || $usercredentials->getPassword() !== $this->password){
          $LoginListener->SetLoginFailed();
          $this->saveUsername = true;
          throw new NotCorrectCredentialsException();
        }


      //gick att logga in
     $_SESSION[self::$loggedInSession] = true;
     $LoginListener->SetLoginSuccess();
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
        session_destroy();
        throw new GoodbyeException();
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
