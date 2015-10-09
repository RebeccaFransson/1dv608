<?php
namespace controller;
class LoginController {

  public function __construct($l, $v){
    $this->LoginView = $v;
    $this->Login = $l;
	}
  public function startLogin(){
      //om vi fått en post och inte är inloggade och credentials INTE är false
      // && $this->LoginView->GetUserCredOK()
      if($this->LoginView->checkLoginPost() && !$this->Login->getIsLoggedIn()){
        //Logga in om inte användarnamn och lösenord är tomt
        $us = $this->LoginView->checkUsercredentials();
        if($this->LoginView->GetUserCredOK()){
          try{
            $this->Login->checkLogin($us, $this->LoginView);
          }catch(\model\NotCorrectCredentialsException $e){
            $this->LoginView->NotCorrectCredentials();
          }
        }
      }
      //Om vi fått logout-post och är inloggade
      else if($this->LoginView->checkLogOut() && $this->Login->getIsLoggedIn()){
        try{
          $this->Login->loggingOut();
          $this->LoginView->SetLoginFailed();
        }catch(\model\GoodbyeException $e){
          $this->LoginView->setGoodbyeMessage();
        }
      }
  }
}
