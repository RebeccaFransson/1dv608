<?php
namespace view;
class NewCategoryView{

  private static $categoryName = 'NewCategory::Name';
  private static $categorySend = 'NewCategory::Send';
  private static $deleteCateg = 'NewCategory::Delete';
  private static $categoryDelete = 'NewCategory::DeleteCategory';

  private $uploadSuccess = false;
  private $message = '';

  public function __construct($DB){
    $this->db = $DB;
  }

//Beroende på om en uppladdning gått bra till så läggs en bit text till innan formuläret
  public function newCategoryResponse(){
    $response = '';
    if($this->uploadSuccess){
      $response = '<p class="success">Category successfully inserted!</p>';
    }
    $response .= $this->newCategoryHTML();
    return $response;
  }
  private function newCategoryHTML(){
    return '
    <div class="form1";
    <p class="errorMessage">' . $this->message . '</p>
      <form method="post">
        <fieldset>
          <legend>Write a new category</legend> <br>
          <p><input type="text" placeholder="Name of category" name="'. self::$categoryName .'" /></p>
          <p><input type="submit" name="' . self::$categorySend . '" value="Insert category" /></p>
        </fieldset>
      </form>
      </div>
      <div class="form2"
        <form method="post">
          <fieldset>
          <p class="errorMessage">(NOT DONE!)</p>
            <legend>Delete category</legend>
            <p><select name="'. self::$categoryDelete .'">
            '. $this->getAllCategories() .'
            </select></p>
            <p><input type="submit" name="' . self::$deleteCateg . '" value="Delete" /></p>
            <a class="back" href="?changeGallery">Back</a>
          </fieldset>
        </form>
      </div>
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

  public function checkNewCategory(){
    return isset($_POST[self::$categorySend]);
  }

  public function checkCategoryInputs(){
    try{
      if(is_string($_POST[self::$categoryName]) === false || strlen($_POST[self::$categoryName]) == 0){
        throw new DescriptionMissingException();
      }
      if(strlen($_POST[self::$categoryName]) != strlen($_POST[self::$categoryName])){
        throw new ContainsInvalidCharException();
      }
      return $_POST[self::$categoryName];
    }catch(DescriptionMissingException $e){
      $this->message = 'Write a description!';
    }catch(ContainsInvalidCharException $e){
      $this->message = 'The category name contains invalid characters!';
    }
  }

  //SETTERS
  public function setInsertSuccess(){
    $this->uploadSuccess = true;
  }
  public function setMessageCategoryExist(){
    $this->message = 'This category allready exists!';
  }
  public function setMessageProblemWithDatabase(){
    $this->message = 'Im sorry, we are having problems with the database! <br> Contact: rf222cz@student.lnu.se';
  }
}
