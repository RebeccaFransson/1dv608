<?php
//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');

require_once('model/UsersDAL.php');

require_once('controller/MasterController.php');
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

//model
//$l = new model\Login();
/*$r = new model\Registration();
//view

//controller
$lc = new controller\LoginController($v);
$rc = new controller\RegisterController($rv, $r);
*/
//sätter igång applikationen
/*$mysqli = new \mysqli("localhost", "root", "", "store");
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
new model\UsersDAL($mysqli);

$lc->runApp();
$rc->startRegistration();*/
$dtv = new view\DateTimeView();
$rv = new view\RegisterView();
$v = new view\LoginView ($rv);
$lv = new view\LayoutView($v, $dtv, $rv);

//sätter igång controllerna
$master = new controller\MasterController();
$master->RunMaster($rv, $v);

//sätter igång vyn
$lv->render();
