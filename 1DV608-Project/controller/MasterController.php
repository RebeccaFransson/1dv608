<?php
namespace controller;
require_once('view/NavigationView.php');
require_once('view/StartView.php');
require_once('view/GalleryView.php');
require_once('view/LoginView.php');
require_once('view/ChangeGalleryView.php');
//controller
require_once('controller/LoginController.php');
//modell
require_once('model/LoginModel.php');

class MasterController{
  public function __construct(){
    $this->Navigation = new \view\NavigationView();
  }

  public function runProgram(){
    $toGalleryLink = false;
    $show = '';
    //kolla om inlogg i url
    if($this->Navigation->checkLogin()){
      $toGalleryLink = true;
      $loginModel = new \model\LoginModel();
      $loginView = new \view\LoginView($loginModel);
      new \controller\LoginController($loginModel, $loginView);
      $show = $loginView->LoginResponse();
    }
    //kolla redigera bilder när man loggat in kommer man till chgnae gallery
    else if($this->Navigation->checkChangeGallery()) {
      $toGalleryLink = true;
      $changeGallery = new \view\changeGalleryView();
      $show = $changeGallery->changeGalleryResponse();
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
