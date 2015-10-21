<?php
namespace model;
class LoginModel{

  public function __construct($DB){
    $this->DB = $DB;
  }
  public function tryToLoggIn($userCredentials){
    $this->DB->tryToLoggIn($userCredentials->getUsername(), $userCredentials->getPassword());
    return true;
  }


}
