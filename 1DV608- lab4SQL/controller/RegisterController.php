<?php

namespace controller;
class RegisterController {

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
            //om allt lyckades rediert till login igen
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
