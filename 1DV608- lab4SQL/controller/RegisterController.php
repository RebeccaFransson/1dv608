<?php

namespace controller;
class RegisterController {
private $urlNewUser = 'Location: http://188.166.116.158/1dv608/Registration/?newuser=';
  public function __construct($rv, $r){
    $this->RegisterView = $rv;
    $this->Registration = $r;
	}

  public function startRegistration(){

    if($this->RegisterView->checkDoRegistration()){
      $rc = $this->RegisterView->checkRegistrationCredentials();
      if($this->RegisterView->GetRegistrationCredOK()){
        try{
          if($this->Registration->checkRegistration($rc)){
            $this->urlNewUser .= $rc->getUsername();
            //om allt lyckades rediert till login igen
            header($this->urlNewUser);
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
