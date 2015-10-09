<?php
namespace controller;
//controller
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');
//view
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
//model
require_once('model/Login.php');
require_once('model/Registration.php');
require_once('model/UsersDAL.php');

class MasterController{

  public function RunProgram(){
    //databas
    $db = new \model\UsersDAL();
    //modell

    //view
    $dtv = new \view\DateTimeView();
    $rv = new \view\RegisterView();

      $l = new \model\Login($db);
      $v = new \view\LoginView($l->getIsLoggedIn());

    $bajs = false;//register

    $navigation = $rv->checkURL();
     if($navigation === 'register'){
       $r = new \model\Registration($db);
       $rc = new RegisterController($rv, $r);
       $rc->startRegistration();
     }else{

       $lc = new LoginController($l, $v);
       $lc->startLogin();
       $bajs = true;
     }

     $lv = new \view\LayoutView($l->getIsLoggedIn(), $v->LoginResponse(), $dtv, $rv->generateRegistrationHTML());///skcika med tre eller false istället för
     $lv->render($bajs);
  }

}


 ?>
