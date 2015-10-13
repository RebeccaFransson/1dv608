<?php
namespace controller;
class LoginController{
  public function __construct($loginModel, $loginView){
    $this->loginModel = $loginModel;
    $this->loginView = $loginView;
    $this->startLogin();
  }
  private function startLogin(){
    //kollar om vi fått en post och om vi inte redan är inloggade
    if($this->loginView->checkLoginButton()){
      $userCredentials = $this->loginView->checkUserCredentials();
      if($this->loginView->getUserCredOK()){//båda input fälten är ifyllda
        echo "nu loggar vi in";
      }
    }
  }
}
