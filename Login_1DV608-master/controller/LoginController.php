<?php

namespace controller;

class LoginController {

  public function __construct($l, $v){
    $this->LoginView = $v;
    $this->Login = $l;
	}

//kollar om användaren vill logga in
  public function tryLogin(){
    //om vi fått en post...
    if($this->LoginView->checkLoginPost()){
      //..hämta inputs sedan...
      $inputs = $this->LoginView->getInputs();
      //...prova att logga in
       if(!$this->Login->checkLogin($inputs)){
          $this->LoginView->response();//gick ej att logga in, presentera errorMessage
       }
    }
  }




}
