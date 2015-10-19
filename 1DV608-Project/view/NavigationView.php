<?php
namespace view;
class NavigationView{
  private static $loginURL = 'login';
  private static $changeGalleryURL = 'changeGallery';
  private static $upload = 'Upload';

  public function checkLogin(){
    return isset($_GET[self::$loginURL]);
  }
  public function checkChangeGallery(){
    return isset($_GET[self::$changeGalleryURL]);
  }
  public function checkUploadImg(){
    return isset($_GET[self::$upload]);
  }

}
