<?php
namespace controller;
class ChangeGalleryController{

  public function __construct($changeGalleryModel, $changeGalleryView){
    $this->changeGalleryModel = $changeGalleryModel;
    $this->changeGalleryView = $changeGalleryView;

    //$this->startUpload();
  }

  public function startUpload(){
    //fått en post
    if($this->changeGalleryView->checkUpload()){
      $newImage = $this->changeGalleryView->checkImageInputs();
      if($this->changeGalleryView->getIMGValidation()){
        if($this->changeGalleryView->uploadImageToServer()){
            $this->changeGalleryModel->newPictureToDB($newImage);
        }
      }
    }
  }

}
