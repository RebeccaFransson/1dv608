<?php
namespace controller;
class ChangeGalleryController{

  public function __construct($DB, $changeGalleryView){
    $this->DB = $DB;
    $this->changeGalleryView = $changeGalleryView;

    //$this->startUpload();
  }

  public function startUpload(){
    //fått en post
    if($this->changeGalleryView->checkUpload()){
      $newImage = $this->changeGalleryView->checkImageInputs();
      if($this->changeGalleryView->getIMGValidation()){
        if($this->changeGalleryView->uploadImageToServer()){
            try{
              $checkExist = $this->DB->checkExistingImage($newImage->getImagePath(), $newImage->getImageDescription(), $newImage->getCategory());
              if($checkExist){
                $imageIsUploaded = $this->DB->uploadNewImage($newImage->getImagePath(), $newImage->getImageDescription(), $newImage->getCategory());
                if($imageIsUploaded){
                  $this->changeGalleryView->imageSuccessUpload();
                }
              }
            }catch(\model\ProblemWithDatabaseException $e){
              $this->changeGalleryView->problemWithDB();
            }catch(\model\ExistingImageException $e){
              $this->changeGalleryView->allreadyExistingImage();
            }
        }
      }
    }
  }

}
