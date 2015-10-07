<?php

namespace controller;
class RegisterController {

  public function __construct($rv, $r){
    $this->RegisterView = $rv;
    $this->Registration = $r;
	}

  public function startRegistration(){
    if($this->RegisterView->checkDoRegistration() && !$this->RegisterView->GetRegistrationFailed()){
      $rc = $this->RegisterView->checkRegistrationCredentials();
      if($this->RegisterView->GetRegistrationCredOK()){
        try{
          $this->Registration->checkRegistration($rc, $this->RegisterView);
        }catch(\model\DifferentPasswordsException $e){
          $this->RegisterView->DifferentPasswords();
        }catch(\model\ExistingUserException $e){
            echo "användarnamn finns redan";
          }

      }
    }
  }
//till min abstracta klass kalla på model och skcika med view
}

 ?>
