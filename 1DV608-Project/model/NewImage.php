<?php
namespace model;
class PathMissingException extends \Exception {};
class DescriptionMissingException extends \Exception {};
class NewImage{
  private $path;
  private $description;
  private $category;

  public function __construct($path, $description, $category){
    $this->path = $path;
    $this->description = $description;
    $this->category = $category;

    if($this->path === NULL){
      throw new PathMissingException();
    }
    if(is_string($this->description) === false || strlen($this->description) == 0){
      throw new DescriptionMissingException();
    }
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
