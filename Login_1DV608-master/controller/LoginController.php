<?php

namespace controller;

class LoginController {

  public $isLoggedIn; //private?

  public function __construct($l, $v){
    $this->LoginView = $v;
    $this->Login = $l;
    //$this->isLoggedIn = $isLoggedIn;
	}

//kollar om användaren vill logga in
  public function tryLogin(){
    if($this->LoginView->checkLoginPost()){
      //hämta inputs
      $inputs = $this->LoginView->getInputs();

      //om uppgifterna var korrekta - logga in
       if($this->Login->checkLogin($inputs)){
         $this->isLoggedIn = true;
       }else{
         //Gick inte att logga in, persentera errorMessage
         $this->LoginView->response();
       }

    }
  }





  public function getIsLoggedIn(){
    return $this->isLoggedIn;
  }



}
