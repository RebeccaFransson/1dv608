<?php
namespace view;
class NavigationView{
  private static $loginURL = 'login';
  private static $changeGalleryURL = 'changeGallery';

  public function checkLogin(){
    return isset($_GET[self::$loginURL]);
  }
  public function checkChangeGallery(){
    return isset($_GET[self::$changeGalleryURL]);
  }

}
