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
    $l = new \model\Login($db);
    //view
    $dtv = new \view\DateTimeView();
    $rv = new \view\RegisterView();
    $v = new \view\LoginView($l, $rv);
    $lv = new \view\LayoutView($l, $v, $dtv, $rv);///skcika med tre eller false istället för


    $navigation = $lv->checkURL();
    var_dump($navigation);
     if($navigation === 'register'){
       $r = new \model\Registration($db);
       $rc = new RegisterController($rv, $r);
       $rc->startRegistration();
       $lv->render(false);
     }else{
       $lc = new LoginController($l, $v);
       $lc->startLogin();
       $lv->render(true);
     }


  }

}


 ?>
