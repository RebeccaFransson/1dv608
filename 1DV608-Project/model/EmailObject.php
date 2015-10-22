<?php
namespace model;
class FirstnameMissingException extends \Exception {};
class LastnameMissingException extends \Exception {};
class EmailAdressMissingException extends \Exception {};
class ClientMessageMissingException extends \Exception {};
class NotValidEmailException extends \Exception {};
class NotValidNameException extends \Exception {};

class EmailObject{
  private $firstName;
  private $lastName;
  private $emailAdress;
  private $clientMessage;
  private $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  private $name_exp = '/^[a-zA-Z ]*$/';

  public function __construct($firstName, $lastName, $emailAdress, $clientMessage){
    if(is_string($firstName) == false || strlen($firstName) == 0){
      throw new FirstnameMissingException();
    }else if(is_string($lastName) == false || strlen($lastName) == 0){
      throw new LastnameMissingException();
    }else if(is_string($emailAdress) == false || strlen($emailAdress) == 0){
      throw new EmailAdressMissingException();
    }else if(is_string($clientMessage) == false || strlen($clientMessage) == 0){
      throw new clientMessageMissingException();
    }else if(!filter_var($emailAdress, FILTER_VALIDATE_EMAIL)){
      throw new NotValidEmailException();
    }else if(!preg_match($this->name_exp, $firstName) || !preg_match($this->name_exp, $lastName)){
      throw new NotValidNameException();
    }
    else{
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->emailAdress = $emailAdress;
      $this->clientMessage = $clientMessage;
    }

  }

  public function getFirstname(){
    return $this->firstName;
  }
  public function getLastname(){
    return $this->lastName;
  }
  public function getEmailAdress(){
    return $this->emailAdress;
  }
  public function getClientMessage(){
    return $this->clientMessage;
  }

}
