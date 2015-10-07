<?php

namespace controller;
require_once('model/Registration.php');

class RegisterController {

  public function __construct($rv){
    $this->RegisterView = $rv;
    $this->Registration = new \model\Registration();
	}

  public function startRegistration(){
    if($this->RegisterView->checkDoRegistration() && !$this->RegisterView->GetRegistrationFailed()){
      $rc = $this->RegisterView->checkRegistrationCredentials();
      if($this->RegisterView->GetRegistrationCredOK()){
        try{
          $this->Registration->checkRegistration($rc, $this->RegisterView);
        }catch(\model\DifferentPasswordsException $e){
          $this->RegisterView->DifferentPasswords();
        }

      }
    }
  }
//till min abstracta klass kalla på model och skcika med view
}

 ?>
