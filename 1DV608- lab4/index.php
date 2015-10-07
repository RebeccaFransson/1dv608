<?php
//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('model/Login.php');
require_once('model/Registration.php');
require_once('model/UsersDAL.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//db
$db = new model\UsersDAL();
//model
$l = new model\Login();
$r = new model\Registration($db);
//view
$dtv = new view\DateTimeView();
$rv = new view\RegisterView();
$v = new view\LoginView($l, $rv);
$lv = new view\LayoutView($l, $v, $dtv, $rv);//vill egentligen itne att vyn ska vara beroende utav modellen så där
//controller
$lc = new controller\LoginController($l, $v);
$rc = new controller\RegisterController($rv, $r);
//sätter igång applikationen
if($rv->checkRegisterNew()){
  $rc->startRegistration();
}else{
  $lc->runApp();
}

//sätter igång vyn
$lv->render();
