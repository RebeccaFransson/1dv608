<?php

namespace model;

class Login {
    private $username = 'Admin';
    private $password = 'Password';

    public function __construct(){
        //$this->userName = $userName;
        //$this->password = $password;

    }

    public function checkLogin($inputs){
           if(empty($inputs["username"])){
             return 'Username is missing';
           }
           if(empty($inputs["password"])){
             return 'Password is missing';
           }
    }
}
//Här vill vi kolla om lösenord och användarnamn stämmer med dem vi skcikat med. som return returnar vi om det är rätt eller fel!
