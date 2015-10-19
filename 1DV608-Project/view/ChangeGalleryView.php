<?php
namespace view;
class InvalidParametersException extends \Exception {};
class ToBigFileException extends \Exception {};
class InvalidFormatException extends \Exception {};
require_once('model/NewImage.php');

class changeGalleryView{
  private static $messageId = 'LoginView::Message';
  private static $sendImg = 'LoginView::SendIMG';
  private static $img = 'LoginView::IMG';
  private static $category = 'LoginView::Category';
  private static $description = 'LoginView::Description';
  private static $upload = 'Upload';

  private $message = '';
  private $IMGValidation = false;

  public function __construct($db){
    $this->db = $db;
  }

  public function changeGalleryResponse(){
    echo " response här skriv message ut";
    $response = $this->changeGalleryHTML($this->message);
    return $response;
  }

  public function changeGalleryHTML($message){
    return '
    <form enctype="multipart/form-data" method="post" action="?'. self::$upload .'" >
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

        <br>
        <input type="submit" name="' . self::$sendImg . '" value="Upload picture" />
      </fieldset>
    </form>
    ';
    //<input type="submit" href="?newCategory" name="" value="Write a new category" />
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

  public function uploadImageToServer(){
    $maxbit = 33554432; //4megabyte
    $okFileFormat = array(
        'application/pdf',
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    );
    $imgLocation = '/var/www/html/1dv608/Project-Gallery/imageUploads/' . basename($_FILES[self::$img]['name']);

    try{
      if(!isset($_FILES[self::$img]['error']) || is_array($_FILES[self::$img]['error'])){
        throw new InvalidParametersException();
      }
      else if ($_FILES[self::$img]['size'] > $maxbit) {
        throw new ToBigFileException();
      }
      else if(!in_array($_FILES[self::$img]['type'], $okFileFormat) && !empty($_FILES[self::$img]["type"])){
        throw new InvalidFormatException();
      }
      else{
        echo "allt gick bra return true";
        move_uploaded_file($_FILES[self::$img]['tmp_name'], $imgLocation);
        return true;
      }
    }catch(InvalidParametersException $e){
      $this->message = 'Invalid parameters.';
    }catch(ToBigFileException $e){
      $this->message = 'Exceeded filesize limit.';
    }catch(InvalidFormatException $e){
      $this->message = 'Invalid file type. Only PDF, JPG, GIF and PNG types are accepted.';
    }
  }


  public function checkUpload(){
    return isset($_POST[self::$sendImg]);
  }
  public function checkImageInputs(){
    try{
      $newimg = new \model\NewImage($_POST[self::$img], $_POST[self::$description], $_POST[self::$category]);
      $this->IMGValidation = true;
      return $newimg;
    }catch(\model\PathMissingException $e){
      $this->message = 'Choose a picture!';
    }catch(\model\DescriptionMissingException $e){
      $this->message = 'Write a description!';
    }
  }

  //GETTERS
  public function getIMGValidation(){
    return $this->IMGValidation;
  }



}
