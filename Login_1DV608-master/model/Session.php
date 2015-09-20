<?php

namespace model;

class Session {
    private $loggingOut = false;

    public function IsThereSession(){
      //kolla omd et finns session, sätt den så fall till true
      session_start();
      return $_SESSION["isSet"];
    }

    /*public function getStoredSession(){//om det finns session ta fram den, annars prova att logga in
      //startar en session
      session_start();
      //om en session redan finns logga in användaren.
        return array(
          "username" => $_SESSION["username"],
          "password" => $_SESSION["password"]);
    }*/

    //spara användaruppgifter till session
    public function storeSession(){
      $_SESSION["isSet"] = true;
    }

    //förstör sessionen
    public function destroySession(){//ta bort logged in när man loggat ut
      //$this->loggingOut = true;
      $_SESSION["isSet"] = false;
      //session_destroy();
      return "Bye bye!";
    }

    /*public function getLoggedOutSession(){//ta bort logged in när man loggat ut
      return $this->loggingOut;
    }*/


}
