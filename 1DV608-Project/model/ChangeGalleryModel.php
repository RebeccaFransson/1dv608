<?php
namespace model;
class ChangeGalleryModel{
  public function __construct($DB){
    $this->DB = $DB;
  }
  public function newPictureToDB($newImage){
    try{
      $this->DB->uploadNewImage($newImage->getImagePath(), $newImage->getImageDescription(), $newImage->getCategory());
    }catch(exeption $e){
      echo "något gick fel "; var_dump($e->Message);
    }

  }
}
