<?php

namespace model;

class Login {
    private $username = 'Admin';
    private $password = 'Password';
    
    public function __construct($POST){
        var_dump($POST);
        $this->usernamePOST = $POST[UserName];
        $this->passwordPOST = $POST[LoginView::Password];
        
    }
    
    public function isLogin(){
           
    }
}
//Här vill vi kolla om lösenord och användarnamn stämmer med dem vi skcikat med. som return returnar vi om det är rätt eller fel!
