<?php

namespace controller;

class LoginController {

  public $isLoggedIn = false;

  public function __construct($l, $v, $s){
    $this->LoginView = $v;
    $this->Login = $l;
    $this->Session = $s;
	}

//kollar om användaren vill logga in
  public function tryLogin(){
    echo "utloggad: ";var_dump($this->Session->getLoggedOut());
    //finns session - logga in med den
    if($this->Session->IsThereSession()){
      //session_destroy();
      //JA - Logga in med session-inputs
      $sessionInputs = $this->Session->getStoredSession();
      if($this->Login->checkLogin($sessionInputs)){
        $this->Login->setIsLoggedIn(true);
      }
    }else{
      //NEJ kolla om vi får en post...
      if($this->LoginView->checkLoginPost()){
        //..hämta inputs sedan...
        $inputs = $this->LoginView->getInputs();
        //...prova att logga in
         if(!$this->Login->checkLogin($inputs)){
            $this->LoginView->response();//gick ej att logga in, presentera errorMessage
            //$this->Login->setIsLoggedIn(true);
         }else{
           //$this->Login->setIsLoggedIn(true);
         }
       }
    }
  }


}
