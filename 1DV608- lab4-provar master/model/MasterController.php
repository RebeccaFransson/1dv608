<?php
namespace controller;
require_once('model/Login.php');
require_once('model/Registration.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');

class MasterController{
  private $LoginController;
  private $RegisterController;

  public function __construct(){
    //skapa conncention t databasen
    
    $this->LoginController = new controller\LoginController($l, $v);
    $this->RegisterController = new controller\RegisterController($rv, $r);
  }
}

 ?>
