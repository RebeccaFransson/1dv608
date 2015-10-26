<?php
namespace model;
class PathMissingException extends \Exception {};
class DescriptionMissingException extends \Exception {};
class NewImage{
  private $path;
  private $description;
  private $category;

/*
Skapar ett nybild-objekt som valideras
*/
  public function __construct($path, $description, $category){
    if($this->path === NULL){
      throw new PathMissingException();
    }
    if(is_string($this->description) === false || strlen($this->description) == 0){
      throw new DescriptionMissingException();
    }
      $this->path = 'http://188.166.116.158/1dv608/Project-Gallery/imageUploads/' . $path;
      $this->description = $description;
      $this->category = $category;

  }

  public function getImagePath(){
    return $this->path;
  }
  public function getImageDescription(){
    return $this->description;
  }
  public function getCategory(){
    return $this->category;
  }

}
