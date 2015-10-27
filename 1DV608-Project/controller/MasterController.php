<?php
namespace controller;
//views
require_once('view/NavigationView.php');
require_once('view/StartView.php');
require_once('view/GalleryView.php');
require_once('view/LoginView.php');
require_once('view/ChangeGalleryView.php');
require_once('view/ContactView.php');
require_once('view/InformationPageView.php');
require_once('view/NewCategoryView.php');
require_once('view/DeletePicturesView.php');
require_once('view/Sessions.php');
//controller
require_once('controller/LoginController.php');
require_once('controller/ChangeGalleryController.php');
require_once('controller/ContactController.php');
require_once('controller/NewCategoryController.php');
//modell
require_once('model/LoginModel.php');
require_once('model/GalleryModel.php');
require_once('model/GalleryDAL.php');
require_once('model/ContactModel.php');

class MasterController{
  private $Navigation;
  private $DB;
  
  public function __construct(){
    $this->Navigation = new \view\NavigationView();
    $this->DB = new \model\GalleryDAL();
  }
/*
MasterControllern kollar URLen för att se vilken sida användaren försöker nå.
Och skcikar sedan användaren dit och sätter igång sidans kontroller.
Kontrollern håller sedan koll på om användaren gör något på den nya sidan.
*/
  public function runProgram(){
    $sessions = new \view\Sessions();
    $show = '';
    //kolla om inlogg i url
    if($this->Navigation->checkLogin()){
      $loginView = new \view\LoginView($sessions);
      $loginModel = new \model\LoginModel($this->DB);
      new \controller\LoginController($loginModel, $loginView);
      $show = $loginView->LoginResponse();
    }
    //kolla redigera bilder när man loggat in kommer man till chgnae gallery
    else if($this->Navigation->checkChangeGallery() && $sessions->checkSessionLoggedIn()) {
      $changeGalleryView = new \view\ChangeGalleryView($this->DB);
      $changeGalleryController = new \controller\ChangeGalleryController($this->DB, $changeGalleryView);
      $changeGalleryController->startUpload();
      $show = $changeGalleryView->changeGalleryResponse();
    }
    else if($this->Navigation->checkNewCategory() && $sessions->checkSessionLoggedIn()) {
      $newCategoryView = new \view\NewCategoryView($this->DB);
      $newCategoryController = new \controller\NewCategoryController($this->DB, $newCategoryView);
      $newCategoryController->startNewCategory();
      $show = $newCategoryView->newCategoryResponse();
    }
    else if($this->Navigation->checkContactPage()) {
      $contactView = new \view\ContactView();
      $contactModel = new \model\ContactModel();
      $contactController = new \controller\ContactController($contactModel, $contactView);
      $contactController->startContactPage();//väntar på att användaren skall skicka ett formulär
      $show = $contactView->contactRender();
    }
    else if($this->Navigation->checkInfoPage()) {
      $informationView = new \view\InformationPageView();
      $show = $informationView->informationPageHTML();
    }
    else if($this->Navigation->checkLogout()) {
      $sessions->setLogoutDestroy();
      header('Location: http://188.166.116.158/1dv608/Project-Gallery/?');
    }
    else{
      $galleryModel = new \model\GalleryModel();
      $galleryView = new \view\GalleryView($this->DB);
      $show = $galleryView->GalleryHTML();
    }

    $start = new \view\StartView($sessions->checkSessionLoggedIn());
    $start->renderLayout($show);

  }

}
