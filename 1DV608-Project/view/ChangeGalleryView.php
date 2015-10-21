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
  private static $upload = 'Upload';

  private $message = '';
  private $IMGValidation = false;
  private $imgUploadSuccsess = false;

  public function __construct($db){
    $this->db = $db;
  }

  public function changeGalleryResponse(){
    //kolla om inloggad i session
    $response = $this->changeGalleryHTML($this->message);
    return $response;
  }

  public function changeGalleryHTML($message){//'. self::$upload .'
    return '
    <form enctype="multipart/form-data" method="post" action="" >
      <fieldset>
        <legend>Upload new picture</legend> <br>
        <p class="errorMessage">' . $message . '</p>
        <p><input type="file" name="' . self::$img . '"></p>
        <p><label>Write a short description</label>
        <input type="text" name="'. self::$description .'" /></p>
        <label>Choose a category</label>
        <select name="'. self::$category .'">
        '. $this->getAllCategories() .'
        </select>
        <p><input type="submit" name="' . self::$sendImg . '" value="Upload picture" /></p>
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
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    );
    $imgLocation = '/var/www/html/1dv608/Project-Gallery/imageUploads/' . basename($_FILES[self::$img]['name']);

    try{
      var_dump($_FILES[self::$img]);
      echo "<br>errors: ";var_dump($_FILES[self::$img]['error']);
      if(!isset($_FILES[self::$img]['error']) || is_array($_FILES[self::$img]['error'])){
        throw new InvalidParametersException();
      }
      else if ($_FILES[self::$img]['size'] > $maxbit) {
        throw new ToBigFileException();
      }
      else if(!in_array($_FILES[self::$img]['type'], $okFileFormat) && !empty($_FILES[self::$img]["type"])){
        throw new InvalidFormatException();
      }
      else if($_FILES[self::$img]['error'] == 0){
        move_uploaded_file($_FILES[self::$img]['tmp_name'], $imgLocation);
        return true;
      }
      else{
        echo "något annat fel har uppstått";
      }
    }catch(InvalidParametersException $e){
      $this->message = 'Invalid parameters.';
    }catch(ToBigFileException $e){
      $this->message = 'Exceeded filesize limit.';
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



}
