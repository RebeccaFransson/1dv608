<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/Login.php');
require_once('model/Session.php');
require_once('controller/LoginController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//model
$s = new model\Session();
$l = new model\Login($s);


//view
$v = new LoginView($l, $s);
$dtv = new DateTimeView();
$lv = new LayoutView();

//controller
$c = new controller\LoginController($l, $v, $s);
//kollar om sessioner finns
$c->tryLogin();


$lv->render($l, $c, $v, $dtv);
