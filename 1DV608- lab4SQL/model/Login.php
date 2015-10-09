<?php
namespace model;
class GoodbyeException extends \Exception {};
session_start();
class Login {
    private static $loggedInSession = 'Login::loggedIn';

    public function __construct($db){
      $this->db = $db;
      //för säkerhetenskull se om det finns en session, om inte sätt den så fall till false
      if(!isset($_SESSION[self::$loggedInSession])){
        $_SESSION[self::$loggedInSession] = false;
      }
    }
    //Kollar om uppgifterna är korrekta
    public function checkLogin(Usercredentials $usercredentials, LoginListener $LoginListener){
      //connect till databasen när jag behöver den.
    	$this->db->connetToDB();
      $this->db->loginSpecificUser($usercredentials->getUsername(), $usercredentials->getPassword());
      //gick att logga in
      $LoginListener->SetLoginSuccess();
     $_SESSION[self::$loggedInSession] = true;
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
