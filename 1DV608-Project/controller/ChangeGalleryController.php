<?php
namespace controller;
class ChangeGalleryController{

private $DB;
private $changeGalleryView;

  public function __construct(\model\GalleryDAL $DB, \view\ChangeGalleryView $changeGalleryView){
    $this->DB = $DB;
    $this->changeGalleryView = $changeGalleryView;

    $this->startUpload();
  }
/*
Väntar på att användaren skall klicka på skicka-knappen.
Ser till att validera bilden vi fått in från användaren.
Om bilden är validerad skickas den upp till servern och sparas där(skrivs över om den redan finns).
Kollar sedan om den sparade bilden redan finns i databasen
Om inte så laddar vi upp den.
Säger till vyn att allt gick bra så ett meddelande kan skrivas ut till användaren
*/
  private function startUpload(){
    if($this->changeGalleryView->checkUpload()){
      $newImage = $this->changeGalleryView->checkImageInputs();
      if($this->changeGalleryView->getIMGValidation()){
        if($this->changeGalleryView->uploadImageToServer()){
            try{
              $checkExist = $this->DB->checkExistingImage($newImage->getImagePath(), $newImage->getCategory());
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
