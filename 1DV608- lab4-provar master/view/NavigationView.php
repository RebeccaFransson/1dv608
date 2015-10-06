<?php
namespace view;
class NavigationView{
  public function checkDoRegistration(){
			return isset($_POST[self::$register]);
	}
}

 ?>
