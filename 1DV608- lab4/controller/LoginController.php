<?php
namespace controller;
require_once('model/Login.php');

class LoginController {

  public function __construct(\view\LoginView $v){
    $this->LoginView = $v;
	}
  public function runApp(){
      //om vi fått en post och inte är inloggade och credentials INTE är false
      // && $this->LoginView->GetUserCredOK()
      if(!$this->LoginView->GetLoginSuccess()){
        //Logga in om inte användarnamn och lösenord är tomt
        try{
          $us = $this->LoginView->checkUsercredentials();
          if($this->LoginView->GetUserCredOK()){
            $this->Login = new \model\Login($us, $this->LoginView);
            $this->Login->checkLogin();
          }
          }catch(\model\NotCorrectCredentialsException $e){
            $this->LoginView->NotCorrectCredentials();
          }
      }
      //Om vi fått logout-post och är inloggade
      else if($this->LoginView->checkLogOut() && $this->LoginView->GetLoginSuccess()){
        //logga ut
        try{
          $this->Login->loggingOut();
        }catch(\model\GoodbyeException $e){
          //visa meddelande i view
          $this->LoginView->setGoodbyeMessage();
        }
      }
  }
}
