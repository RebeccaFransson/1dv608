<?php
namespace view;
class NavigationView{
  private static $loginURL = 'login';
  private static $changeGalleryURL = 'changeGallery';
  private static $contactPageURL = 'contact';

  public function checkLogin(){
    return isset($_GET[self::$loginURL]);
  }
  public function checkChangeGallery(){
    return isset($_GET[self::$changeGalleryURL]);
  }
  public function checkContactPage(){
    return isset($_GET[self::$contactPageURL]);
  }

}
