<?php
namespace model;
class LoginRegisterFacade{
  public function __construct($lc, $rc) {
		//$this->dal = $db;
		//$this->products = $db->getProducts(); //extract cache
    $lc->runApp();
    $rc->startRegistration();
	}
}

 ?>
