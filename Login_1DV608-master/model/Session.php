<?php

namespace model;

class Session {
    private $loggingOut = false;

    public function IsThereSession(){
      session_start();
      if(isset($_SESSION["username"])){
        return true;
      }
        return false;
    }

    public function getStoredSession(){//om det finns session ta fram den, annars prova att logga in
      //startar en session
      session_start();
      //om en session redan finns logga in användaren.
        return array(
          "username" => $_SESSION["username"],
          "password" => $_SESSION["password"]);
    }

    //spara användaruppgifter till session
    public function storeSession($inputs){
      $_SESSION["username"] = $inputs["username"];
      $_SESSION["password"] = $inputs["password"];
    }

    //förstör sessionen
    public function destroySession(){//ta bort logged in när man loggat ut
      $this->loggingOut = true;
      session_destroy();
      return "Bye bye!";
    }

    public function getLoggedOut(){//ta bort logged in när man loggat ut
      
      return $this->loggingOut;
    }


}
