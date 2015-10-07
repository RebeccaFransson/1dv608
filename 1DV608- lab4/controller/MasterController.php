<?php
namespace controller;

require_once('controller/RegisterController.php');
require_once('controller/LoginController.php');
require_once('view/NavigationView.php');
class MasterController{

private $navigationView;
  public function __construct() {
    //databas conecction
    $this->navigationView = new \view\NavigationView();
  }

  public function RunMaster($rv, $v){
    //registerings-sidan?
    if($this->navigationView->checkRegister()){
      $rc = new RegisterController($rv);
      $rc->startRegistration();
    }else{
      if($this->navigationView->checkLoginPost2()){
        $lc = new LoginController($v);
        $lc->runApp();
      }else if($this->navigationView->checksession()){
        echo "finns session sätt till inloggad";
      }
    }

  }
}

 ?>
