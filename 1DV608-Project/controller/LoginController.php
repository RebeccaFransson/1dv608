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
        try{
          $loggedIn = $this->loginModel->tryToLoggIn($userCredentials);
          if($loggedIn){
            $this->loginView->successLogin();
            //header('Location: http://188.166.116.158/1dv608/Project-Gallery/?changeGallery');
          }
        }catch(\model\NotCorrectCredentialsException $e){
          $this->loginView->notCorrectCredentials();
        }

      }
    }
  }
}
