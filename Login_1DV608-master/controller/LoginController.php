<?php

namespace controller;

class LoginController {

  private $isLoggedInC = false;

  public function __construct($l, $v, $s){
    $this->LoginView = $v;
    $this->Login = $l;
    $this->Session = $s;
	}
//måste ha isloggedin här för när det finsn session så ska den sättas till true här
//kollar om användaren vill logga in
  public function tryLogin(){

    //echo "<br>utloggad: ";var_dump($this->Session->getLoggedOut());
    //finns session - logga in med den
    if($this->Session->IsThereSession()){
      echo "<br>Ja sessions finns";
      $this->isLoggedInC = true;
    }else{
      echo "<br>Ingen session, kolla om post -> logga in";
      //NEJ kolla om vi får en post...
      if($this->LoginView->checkLoginPost()){
        //..hämta inputs sedan...
        $inputs = $this->LoginView->getInputs();
        //...prova att logga in
         if(!$this->Login->checkLogin($inputs)){
            $this->LoginView->response();//gick ej att logga in, presentera errorMessage
            $this->isLoggedInC = false;
         }else{
           $this->isLoggedInC = true;
         }
       }
    }
  }

  public function getIsLoggedInC(){
    echo "<br> vi kommer inte ens hit eller hur?";
    //om utloggad
    var_dump($this->LoginView->loggingOut());
    if($this->LoginView->loggingOut()){
      echo "<br> ett utlogg har skett";
      return false;
    }
    return $this->isLoggedInC;
  }

}
