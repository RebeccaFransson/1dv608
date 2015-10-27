<?php
namespace controller;
class LoginController{

private $loginModel;
private $loginView;

  public function __construct(\model\LoginModel $loginModel, \view\LoginView $loginView){
    $this->loginModel = $loginModel;
    $this->loginView = $loginView;
    $this->startLogin();
  }
/*
Väntar på att användaren skall klicka på knappen
Validerar inputfälten
Gick valideringen bra så provar vi att logga in
Om inloggningen gick bra så ber vi vyn meddela användaren
Fångar också exeptions i modellen här och ber vyn skriva ut felmeddelandet till användaren
*/
  private function startLogin(){
    //kollar om vi fått en post och om vi inte redan är inloggade
    if($this->loginView->checkLoginButton()){
      $userCredentials = $this->loginView->checkUserCredentials();
      if($this->loginView->getUserCredOK()){//båda input fälten är ifyllda
        try{
          $loggedIn = $this->loginModel->tryToLoggIn($userCredentials);
          if($loggedIn){
            $this->loginView->successLogin();
          }
        }catch(\model\NotCorrectCredentialsException $e){
          $this->loginView->notCorrectCredentials();
        }
      }
    }
  }
}
