<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once('controller/MasterController.php');
echo "hejsan";

$master = new controller\MasterController();
$master->RunProgram();
