<?php
namespace controller;
require_once('view/NavigationView.php');
require_once('view/StartView.php');
require_once('view/GalleryView.php');
require_once('view/LoginView.php');

class MasterController{
  public function __construct(){
    $this->Navigation = new \view\NavigationView();
  }

  public function RunProgram(){
    $toGalleryLink = false;
    $show = '';
    //kolla om inlogg i url
    if($this->Navigation->checkLogin()){
      $toGalleryLink = true;
      $login = new \view\LoginView();
      $show = $login->LoginResponse();
    }
    //kolla redigera bilder när man loggat in kommer man till chgnae gallery
    else if($this->Navigation->checkChangeGallery()) {
      $toGalleryLink = true;
      echo "change gallery";
        $show = 'changeGallery';
    }
    //else galley
    else{
      $gallery = new \view\GalleryView();
      $show = $gallery->GalleryHTML();
    }

    $start = new \view\StartView($toGalleryLink);
    $start->renderLayout($show);

  }

}
