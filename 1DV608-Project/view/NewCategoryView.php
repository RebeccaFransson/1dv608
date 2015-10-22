<?php
namespace view;
class NewCategoryView{

  private static $categoryName = 'NewCategory::Name';
  private static $categorySend = 'NewCategory::Send';

  private $uploadSuccess = false;
  private $message = '';

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
      <form method="post">
        <fieldset>
          <legend>Write a new category</legend> <br>
          <p class="errorMessage">' . $this->message . '</p>
          <p><input type="text" placeholder="Name of category" name="'. self::$categoryName .'" /></p>
          <p><input type="submit" name="' . self::$categorySend . '" value="Insert category" /></p>
        </fieldset>
      </form>
    ';
  }
  public function checkNewCategory(){
    return isset($_POST[self::$categorySend]);
  }
  public function checkCategoryInputs(){
    try{
      if(is_string($_POST[self::$categoryName]) === false || strlen($_POST[self::$categoryName]) == 0){
        throw new DescriptionMissingException();
      }
      return $_POST[self::$categoryName];
    }catch(DescriptionMissingException $e){
      $this->message = 'Write a description!';
    }
  }
  public function setInsertSuccess(){
    $this->uploadSuccess = true;
  }
}
