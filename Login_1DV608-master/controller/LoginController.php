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
      //var_dump($inputs);
      $RespMessage = $this->Login->checkLogin($inputs);
      //skcika responseMessage till view
      //var_dump($RespMessage);
      $this->LoginView->response($RespMessage);
    }
  }



}
