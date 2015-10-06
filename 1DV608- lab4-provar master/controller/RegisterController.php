<?php
namespace controller;

class RegisterController {

  public function __construct($rv, $r){
    $this->RegisterView = $rv;
    $this->Registration = $r;
	}

  public function startRegistration(){
    if($this->RegisterView->checkDoRegistration() && !$this->RegisterView->GetRegistrationFailed()){
      $rcred = $this->RegisterView->checkRegistrationCredentials();
      if($this->RegisterView->GetRegistrationCredOK()){
        try{
          $this->Registration->checkRegistration($rcred, $this->RegisterView);
        }catch(\model\DifferentPasswordsException $e){
          $this->RegisterView->DifferentPasswords();
        }

      }
    }
  }
//till min abstracta klass kalla på model och skcika med view
}

 ?>
