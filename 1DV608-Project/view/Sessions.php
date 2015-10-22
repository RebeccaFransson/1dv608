<?php
namespace view;
class Sessions{
  private static $loginSession = 'LoginView::LoginSession';
  public function __construct(){
    if(!isset($_SESSION[self::$loginSession])){
        $_SESSION[self::$loginSession] = false;
      }
  }

  public function setSessionLoggedIn(){
    $_SESSION[self::$loginSession] = true;
  }
  public function checkSessionLoggedIn(){
    return $_SESSION[self::$loginSession];
  }
  public function setLogoutDestroy(){
    if(isset($_SESSION[self::$loginSession])){
        if($_SESSION[self::$loginSession]){
          $_SESSION[self::$loginSession] = false;
        }
        session_destroy();
      }
  }
}
