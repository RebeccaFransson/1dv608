<?php
namespace view;
class NavigationView{
  private static $inUrl = 'register';
  private static $login = 'LoginView::Login';
  private static $loggedInSession = 'Login::loggedIn';
  public function __construct(){
    if(!isset($_SESSION[self::$loggedInSession])){
      $_SESSION[self::$loggedInSession] = false;
    }
  }

  public function checkRegister(){
    return isset($_GET[self::$inUrl]);
  }

  public function checkLoginPost2(){
    return isset($_POST[self::$login]);
  }

  public function checkSession(){
    return $_SESSION[self::$loggedInSession];
  }
}

 ?>
