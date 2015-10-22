<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once('controller/MasterController.php');

$master = new controller\MasterController();
$master->runProgram();
