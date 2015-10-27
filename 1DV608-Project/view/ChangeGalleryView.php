<?php
namespace view;
class InvalidParametersException extends \Exception {};
class ToBigFileException extends \Exception {};
class InvalidFormatException extends \Exception {};
require_once('model/NewImage.php');

class ChangeGalleryView{
  private static $messageId = 'LoginView::Message';
  private static $sendImg = 'LoginView::SendIMG';
  private static $img = 'LoginView::IMG';
  private static $category = 'LoginView::Category';
  private static $description = 'LoginView::Description';

  private $message = '';
  private $IMGValidation = false;
  private $imgUploadSuccsess = false;
  private $db;

  public function __construct($db){
    $this->db = $db;
  }
/*
Lägger till en bit text om en bild har laddas upp
*/
  public function changeGalleryResponse(){
    $response = '';
    if($this->imgUploadSuccsess){
      $this->imgUploadSuccsess = false;
      $response = '<p class="success">Image successfully uploaded!</p>';
    }
    $response .= $this->changeGalleryHTML();
    return $response;
  }

  public function changeGalleryHTML(){
    return '
    <p class="errorMessage">' . $this->message . '</p>
    <form enctype="multipart/form-data" method="post" action="" >
      <fieldset>
        <legend>Upload new picture</legend> <br>
        <p><input type="file" name="' . self::$img . '"></p>
        <p><label>Write a short description</label><br>
        <input type="text" name="'. self::$description .'" /></p>
        <p><label>Choose a category</label>
        <select name="'. self::$category .'">
        '. $this->getAllCategories() .'
        </select></p>
        <p><input type="submit" name="' . self::$sendImg . '" value="Upload picture" /></p>
        <p><a href="?newCategory"/>Remove/add categorys</a></p>
        <p><a class="back" href="?login">Back</a></p>
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

  public function uploadImageToServer(){
    $okFileFormat = array(
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    );
    $imgLocation = '/var/www/html/1dv608/Project-Gallery/imageUploads/' . basename($_FILES[self::$img]['name']);

    try{
      if(!isset($_FILES[self::$img]['error']) || is_array($_FILES[self::$img]['error'])){
        // Undefined | Flera Filer
        throw new InvalidParametersException();
      }else if ($_FILES[self::$img]['error'] == 1) {
        //upload_max_filesize i php.ini = 2M
        throw new ToBigFileException();
      }else if(!in_array($_FILES[self::$img]['type'], $okFileFormat) && !empty($_FILES[self::$img]["type"])){
        throw new InvalidFormatException();
      }
      //inga errors lägg till bilden på servern
      else if($_FILES[self::$img]['error'] == 0){
        move_uploaded_file($_FILES[self::$img]['tmp_name'], $imgLocation);
        return true;
      }
      //okända fel
      else{
        $this->message =  "Oväntat fel på servern, vi beklagar! :(";
      }
    }catch(InvalidParametersException $e){
      $this->message = 'Invalid parameters.';
    }catch(ToBigFileException $e){
      $this->message = 'Exceeded filesize limit on 2 megabyte.';
    }catch(InvalidFormatException $e){
      $this->message = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
    }
  }


  public function checkUpload(){
    return isset($_POST[self::$sendImg]);
  }
  public function checkImageInputs(){
    try{
      $newimg = new \model\NewImage($_FILES[self::$img]['name'], $_POST[self::$description], $_POST[self::$category]);
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
  public function getImgUploadSuccsess(){
    return $this->imgUploadSuccsess;
  }
  //SETTERS
  public function imageSuccessUpload(){
    $this->imgUploadSuccsess = true;
  }
  //SET MESSAGE! EXEPTIONS FROM CONTROLLER
  public function allreadyExistingImage(){
    $this->message = 'Image is already in the gallery!';
  }
  public function problemWithDB(){
    $this->message = 'Ops! Someting went wrong when importing the image, try again!';
  }


}
