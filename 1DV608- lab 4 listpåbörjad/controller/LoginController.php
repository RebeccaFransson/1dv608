<?php
namespace controller;
class LoginController {

  public function __construct($l, $v){
    $this->LoginView = $v;
    $this->Login = $l;
	}
  public function runApp(){
      //om vi fått en post och inte är inloggade och credentials INTE är false
      if($this->LoginView->checkLoginPost() && !$this->Login->getIsLoggedIn() && !$this->LoginView->GetLoginFailed()){
        //Logga in
        $this->Login->checkLogin($this->LoginView->checkUsercredentials(), $this->LoginView);
        //sätt meddelande till view
        $this->LoginView->setErrorMessage($this->Login->getErrorMessage());
      }
      //Om vi fått logout-post och är inloggade
      else if($this->LoginView->checkLogOut() && $this->Login->getIsLoggedIn()){
        //logga ut
        $this->Login->loggingOut();
        //visa meddelande i view
        $this->LoginView->setErrorMessage($this->Login->getErrorMessage());
      }
  }
}
