<?php
//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/Login.php');
require_once('controller/LoginController.php');
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
//model
$l = new model\Login();
//view
$dtv = new DateTimeView();
$lv = new LayoutView();
$v = new LoginView($l);
//controller
$c = new controller\LoginController($l, $v);
//sätter igång applikationen
$c->runApp();
$lv->render($l, $v, $dtv);
