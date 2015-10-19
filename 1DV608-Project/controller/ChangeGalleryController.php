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
        //kanske kolla om upladimgaeToServer retunerar true och gå då vidare till modellen
        //gör sedan en url till bilden i modellen
        if($this->changeGalleryView->uploadImageToServer()){
            echo "bilden laddades upp korrekt";
        }
      }
      //var_dump($newImage->getImageDescription());

    }
  }

}
