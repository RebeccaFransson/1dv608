<?php
namespace model;
class Image{
  private $id;
  private $name;
  private $url;

  public function __construct($id, $name, $url){
    $this->id = $id;
    $this->name = $name;
    $this->url = $url;
  }

  public function getImageId(){
    return $this->id;
  }
  public function getImageName(){
    return $this->name;
  }
  public function getImageUrl(){
    return $this->url;
  }

}
