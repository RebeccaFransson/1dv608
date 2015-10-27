<?php
namespace view;
class GalleryView{

  private static $category = 'category';
  private $db;
  
  public function __construct($db){
    $this->db = $db;
  }
/*
Beroende på om man redan valt en kategori eller inte visas kategorierna eller alla bilder inom en vald kategori
Här kommer sedan också vara mer kod om vad som skall hända om man klickar på en bild och vill förstora den
*/
  public function galleryHTML(){
    $wholeGallery = '';
    if(isset($_GET[self::$category])){
      $wholeGallery = $this->galleyByCategory($_GET[self::$category]);
    }else{
      $wholeGallery .= $this->galleryCategorys();
    }
    return $wholeGallery;
  }

//skriver ut kategorierna
  public function galleryCategorys(){
    $AllCategorys = '';
    try{
      $categorys = $this->db->getCategorys();
      foreach ($categorys as $key) {
        $AllCategorys .= '<div class="category_name"><a href="?category=';
        $AllCategorys .= $key.'">';
        $AllCategorys .= $key.'</a></div>';
      }
    }catch(\model\NoCategorysException $e){
        $AllCategorys = '<p class="errorMessage">There is no categorys in the database!</p>';
    }
    return $AllCategorys;
  }

//skriver ut bilderna för en vald katergori
  public function galleyByCategory($category){
    $wholeGallery = '';
    try{
      $imagesArray = $this->db->getImagesByCategory($category);
      foreach ($imagesArray as $key) {
        $newImgTag = '<div class="img"><img src="';
        $newImgTag .= $key->getImageUrl().'" alt="';
        $newImgTag .= $key->getImageName().'" style="width:100%;"></div>';
        $wholeGallery .= $newImgTag;
      }
    }catch(\model\NoImagesByCategoryException $e){
      $wholeGallery = '<p class="errorMessage">There is no images in the '.$category.'-category!</p><br>
      <a href="?">Back</a>';
    }
    return $wholeGallery;
  }
}
