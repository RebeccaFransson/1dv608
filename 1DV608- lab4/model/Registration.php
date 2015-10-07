<?php
namespace model;
class DifferentPasswordsException extends \Exception {};

class Registration{

  public function __construct($db){
    $this->db = $db;
    //conncet to db
  }

  public function checkRegistration(RegistrationCredentials $regiCred, RegisterListener $registerListener){
    //kolla om vi kan registrera ny
    /*if($regiCred->getPassword() != $regiCred->getRepeatPassword()){
      throw new DifferentPasswordsException();
    }*/
    //skapar connection när jag beöver den
    $this->db->connetToDB();

    $this->db->existingUser($regiCred->getUsername());
    echo "lägg till användaren";
    $this->db->addUser();



  }

}
