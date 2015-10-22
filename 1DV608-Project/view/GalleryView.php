<?php
namespace view;
class GalleryView{

  private static $category = 'category';
  public function __construct($db){
    $this->db = $db;
  }

  public function galleryHTML(){
    $wholeGallery = '';
    if(isset($_GET[self::$category])){
      $wholeGallery = $this->galleyByCategory($_GET[self::$category]);
    }else{
      $wholeGallery .= $this->galleryCategorys();
    }
    return $wholeGallery;
  }

  public function galleryCategorys(){
    $AllCategorys = '';
    try{
      $categorys = $this->db->getCategorys();
      foreach ($categorys as $key) {
        $AllCategorys .= '<div class="category_name"><a href="?category=';
        $AllCategorys .= $key.'">';
        $AllCategorys .= $key.'</a></div>';
      }
    }catch(NoCategorysException $e){
        $AllCategorys = '<p class="errorMessage">There is no categorys in the database!</p>';
    }
    return $AllCategorys;
  }

  public function galleyByCategory($category){
    $imagesArray = $this->db->getImagesByCategory($category);
    $wholeGallery = '';
    foreach ($imagesArray as $key) {
      $newImgTag = '<div class="img"><img src="';
      $newImgTag .= $key->getImageUrl().'" alt="';
      $newImgTag .= $key->getImageName().'" style="width:100%;"></div>';
      $wholeGallery .= $newImgTag;
    }
    return $wholeGallery;
  }




}
