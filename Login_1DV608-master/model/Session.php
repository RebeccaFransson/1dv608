<?php

namespace model;

class Session {


    public function IsSessionStored($c, $l){//om det finns session ta fram den, annars prova att logga in

session_start();
    //session_destroy();
      if(isset($_SESSION["username"])){
        $inputs = array(
          "username" => $_SESSION["username"],
          "password" => $_SESSION["password"]);
          if($l->checkLogin($inputs)){
            $c->isLoggedIn = true;
          }
        //logga in
      }else{
        $c->tryLogin();
      }
    }

    public function storeSession($inputs){
      //spara inputs till session
      $_SESSION["username"] = $inputs["username"];
      $_SESSION["password"] = $inputs["password"];
    }

    public function destroySession(){
      session_destroy();
    }

}
