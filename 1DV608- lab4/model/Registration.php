<?php
namespace model;
class DifferentPasswordsException extends \Exception {};

class Registration{

  public function checkRegistration(RegistrationCredentials $regiCred, RegisterListener $registerListener){
    //kolla om vi kan registrera ny
    if($regiCred->getPassword() != $regiCred->getRepeatPassword()){
      throw new DifferentPasswordsException();

    }
  }

}

 ?>
