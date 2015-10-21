<?php
namespace controller;
//views
require_once('view/NavigationView.php');
require_once('view/StartView.php');
require_once('view/GalleryView.php');
require_once('view/LoginView.php');
require_once('view/ChangeGalleryView.php');
require_once('view/ContactView.php');
//controller
require_once('controller/LoginController.php');
require_once('controller/GalleryController.php');
require_once('controller/ChangeGalleryController.php');
require_once('controller/ContactController.php');
//modell
require_once('model/LoginModel.php');
require_once('model/GalleryModel.php');
require_once('model/GalleryDAL.php');
require_once('model/ChangeGalleryModel.php');
require_once('model/ContactModel.php');

class MasterController{
  public function __construct(){
    $this->Navigation = new \view\NavigationView();
  //  $this->DB = new \model\GalleryDAL();
    $this->DB = '';
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
      $changeGalleryView = new \view\ChangeGalleryView($this->DB);
      $changeGalleryModel = new \model\ChangeGalleryModel($this->DB);
      $toGalleryLink = true;
      $changeGalleryController = new \controller\ChangeGalleryController($changeGalleryModel, $changeGalleryView);
      $changeGalleryController->startUpload();
      $show = $changeGalleryView->changeGalleryResponse();
    }
    else if($this->Navigation->checkContactPage()) {
      $contactView = new \view\ContactView();
      $contactModel = new \model\ContactModel();
      $contactController = new \controller\ContactController($contactModel, $contactView);
      $contactController->startContactPage();//väntar på att användaren skall skicka ett formulär
      $show = $contactView->contactHTML();
    }
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
