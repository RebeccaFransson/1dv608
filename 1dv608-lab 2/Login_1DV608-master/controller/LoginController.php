<?php
namespace controller;
class LoginController {
  private $isLoggedInC = false;
  public function __construct($l, $v){
    $this->LoginView = $v;
    $this->Login = $l;
	}
  public function runApp(){
      //om vi fått en post och inte är inloggade
      if($this->LoginView->checkLoginPost() && !$this->Login->getIsLoggedIn()){
        //Logga in
        $this->Login->checkLogin($this->LoginView->getInputs());
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
