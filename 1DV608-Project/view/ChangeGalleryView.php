<?php
namespace view;
require_once('model/NewImage.php');

class changeGalleryView{
  private static $messageId = 'LoginView::Message';
  private static $sendImg = 'LoginView::SendIMG';
  private static $img = 'LoginView::IMG';
  private static $category = 'LoginView::Category';
  private static $description = 'LoginView::Description';

  private $message = '';

  public function __construct($db){
    $this->db = $db;
  }

  public function changeGalleryResponse(){
    $response = $this->changeGalleryHTML($this->message);
    return $response;
  }

  public function changeGalleryHTML($message){
    return '
    <form method="post" >
      <fieldset>
        <legend>Upload new picture</legend>
        <p class="errorMessage">' . $message . '</p>
        <input type="file" name="' . self::$img . '">
        <p>Write a short description</p>
        <input type="text" name="'. self::$description .'" />
        <p>Choose a category</p>
        <select name="'. self::$category .'">
        '. $this->getAllCategories() .'
        </select>
        <input type="submit" name="" value="Write a new category" />
        <br>
        <input type="submit" name="' . self::$sendImg . '" value="Upload picture" />
      </fieldset>
    </form>
    ';
  }

  public function getAllCategories(){
    $categoryArray = $this->db->getCategorys();
    $select = '';
    foreach ($categoryArray as $key) {
      $options = '<option>';
      $options .= $key.'</option>';
      $select .= $options;
    }
    return $select;
  }


  public function checkUpload(){
    return isset($_POST[self::$sendImg]);
  }
  public function checkImageInputs(){
    try{
      return new \model\NewImage($_POST[self::$img], $_POST[self::$description], $_POST[self::$category]);
    }catch(\model\PathMissingException $e){
      $this->message = 'Choose a picture!';
    }catch(\model\DescriptionMissingException $e){
      $this->message = 'Write a description!';
    }
  }



}
