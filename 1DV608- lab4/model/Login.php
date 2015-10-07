<?php
namespace model;
class NotCorrectCredentialsException extends \Exception {};
class GoodbyeException extends \Exception {};
session_start();
class Login {
    private $username = 'Admin';
    private $password = 'Password';


    public function __construct(Usercredentials $usercredentials, LoginListener $LoginListener){
      echo "kolla här om det finns session?";
      //för säkerhetenskull se om det finns en session, om inte sätt den så fall till false

      $this->usercred = $usercredentials;
      $this->LoginListener = $LoginListener;
    }
    //Kollar om uppgifterna är korrekta
    public function checkLogin(){
      //ej rätt uppgifter
    		if ($this->usercred->getUsername() !== $this->username || $this->usercred->getPassword() !== $this->password){
          $this->LoginListener->SetLoginFailed();
          throw new NotCorrectCredentialsException();
        }
      //gick att logga in

     $this->LoginListener->SetLoginSuccess();
    }
    public function loggingOut(){
      //loggar ut, sätter sessionen till false och förstör den

        throw new GoodbyeException();

    }
    public function getIsLoggedIn(){
      //finns det en sparad session?
    
    }
}
