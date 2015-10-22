<?php
namespace view;
class NavigationView{
  private static $loginURL = 'login';
  private static $changeGalleryURL = 'changeGallery';
  private static $contactPageURL = 'contact';
  private static $infoPageURL = 'information';
  private static $logoutURL = 'logout';

  public function checkLogin(){
    return isset($_GET[self::$loginURL]);
  }
  public function checkChangeGallery(){
    return isset($_GET[self::$changeGalleryURL]);
  }
  public function checkContactPage(){
    return isset($_GET[self::$contactPageURL]);
  }
  public function checkInfoPage(){
    return isset($_GET[self::$infoPageURL]);
  }
  public function checkLogout(){
    return isset($_GET[self::$logoutURL]);
  }

}
