<?php

namespace controller;

class LoginController {

  public function __construct($l, $v){
    $this->LoginView = $v;
    $this->Login = $l;
	}

  public function TryLogin(){
    var_dump($this->LoginView);
    if($this->LoginView){
      $this->Login->checkLogin($this->LoginView);
    }
  }



}
