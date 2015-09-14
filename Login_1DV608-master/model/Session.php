<?php

namespace model;

class Session {


    public function IsSessionStored($c){//om det finns session ta fram den, annars prova att logga in
      var_dump();
      if(isset($login_session)){
        echo "finns session";
      }else{
        echo "ingen session";
        $c->tryLogin();
      }
    }

    public function storeSession($inputs){
      //spara inputs till session
    }

}
