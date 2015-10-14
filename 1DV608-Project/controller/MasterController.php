<?php
namespace controller;
require_once('view/NavigationView.php');
require_once('view/StartView.php');
require_once('view/GalleryView.php');
require_once('view/LoginView.php');
require_once('view/ChangeGalleryView.php');
//controller
require_once('controller/LoginController.php');
require_once('controller/GalleryController.php');
require_once('controller/ChangeGalleryController.php');
//modell
require_once('model/LoginModel.php');
require_once('model/GalleryModel.php');
require_once('model/GalleryDAL.php');
require_once('model/ChangeGalleryModel.php');

class MasterController{
  public function __construct(){
    $this->Navigation = new \view\NavigationView();
    $this->DB = new \model\GalleryDAL();
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
      $changeGalleryModel = new \model\ChangeGalleryModel();
      $toGalleryLink = true;
      $changeGalleryView = new \view\changeGalleryView($this->DB);
      new \controller\ChangeGalleryController($changeGalleryModel, $changeGalleryView);
      $show = $changeGalleryView->changeGalleryResponse();
    }
    //else galley
    else{
      $galleryModel = new \model\GalleryModel();
      $galleryView = new \view\GalleryView($this->DB);
      new \controller\GalleryController($galleryModel, $galleryView);
      $show = $galleryView->GalleryHTML();
    }

    $start = new \view\StartView($toGalleryLink);
    $start->renderLayout($show);

  }

}
