<?php
namespace controller;
class ChangeGalleryController{

  public function __construct($changeGalleryModel, $changeGalleryView){
    $this->changeGalleryModel = $changeGalleryModel;
    $this->changeGalleryView = $changeGalleryView;

    $this->startUpload();
  }

  private function startUpload(){
    //fått en post
    if($this->changeGalleryView->checkUpload()){
      $newImage = $this->changeGalleryView->checkImageInputs();
      var_dump($newImage->getImageDescription());
      echo " nu vill vi ladda upp";
    }
  }

}
