<?php
namespace controller;
class NewCategoryController{
  public function __construct($DB, $newCategoryView){
    $this->DB = $DB;
    $this->newCategoryView = $newCategoryView;
  }
  public function startNewCategory(){
    if($this->newCategoryView->checkNewCategory()){
      $newCategory = $this->newCategoryView->checkCategoryInputs();
      try{
        $this->DB->insertNewCategory($newCategory);
        $this->newCategoryView->setInsertSuccess();
      }catch(\model\ExistingImageException $e){
        echo "ExistingImageException";
      }catch(\model\ProblemWithDatabaseException $e){
        echo "ProblemWithDatabaseException";
      }

    }
  }
}
