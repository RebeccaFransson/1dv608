<?php
namespace model;
class LoginModel{
  private $DB;
  
  public function __construct($DB){
    $this->DB = $DB;
  }
  /*
Provar att logga in
(databas-funktioen hade kunnat kallas på i kontrollern istället.)
  */
  public function tryToLoggIn($userCredentials){
    $this->DB->tryToLoggIn($userCredentials->getUsername(), $userCredentials->getPassword());
    return true;
  }


}
