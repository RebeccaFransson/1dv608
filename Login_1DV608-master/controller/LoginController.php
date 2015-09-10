<?php

namespace controller;

class LoginController {

  public function __construct($l, $v){
    $this->LoginView = $v;
    $this->Login = $l;
	}

//kollar om användaren vill logga in
  public function TryLogin(){
    if($this->LoginView->checkLoginPost()){
      //hämta inputs
      $inputs = $this->LoginView->getInputs();

       if($this->Login->checkLogin($inputs)){//om uppgifterna var korrekta - logga in
         echo 'gick att logga in';
       }else{
         echo "gick inte att logga in";
         $this->LoginView->response();
       }

    }
  }



}
