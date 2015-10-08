<?php

namespace controller;
class RegisterController {
private static $usernameSession = 'Login::username';

private static $urlNewUser = 'Location: http://188.166.116.158/1dv608/Registration/';

  public function __construct($rv, $r){
    $this->RegisterView = $rv;
    $this->Registration = $r;
    if(!isset($_SESSION[self::$usernameSession])){
      $_SESSION[self::$usernameSession] = false;
    }
	}

  public function startRegistration(){

    if($this->RegisterView->checkDoRegistration()){
      $rc = $this->RegisterView->checkRegistrationCredentials();
      if($this->RegisterView->GetRegistrationCredOK()){
        try{
          if($this->Registration->checkRegistration($rc)){
            $this->urlNewUser .= $rc->getUsername();
            //om allt lyckades rediert till login igen
            $_SESSION[self::$usernameSession] = $rc->getUsername();
            header(self::$urlNewUser);
          }
        }catch(\model\DifferentPasswordsException $e){
          $this->RegisterView->DifferentPasswords();
        }catch(\model\ExistingUserException $e){
            $this->RegisterView->ExistingUser();
          }
      }
    }
  }
//till min abstracta klass kalla på model och skcika med view
}

 ?>
