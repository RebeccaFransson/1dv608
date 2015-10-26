<?php
namespace controller;
class NewCategoryController{

  public function __construct(\model\GalleryDAL $DB, \view\NewCategoryView $newCategoryView){
    $this->DB = $DB;
    $this->newCategoryView = $newCategoryView;
  }
/*
Väntar på att användaren skall klicka på skicka-knappen
Validerar inputfältet
Gick valideringen bra så lägg till den nya kategorin i databasen
Fångar exept i modellen och säger till vyn att skriva ut meddelandet till användaren
*/
  public function startNewCategory(){
    if($this->newCategoryView->checkNewCategory()){
      $newCategory = $this->newCategoryView->checkCategoryInputs();
      try{
        $this->DB->insertNewCategory($newCategory);
        $this->newCategoryView->setInsertSuccess();
      }catch(\model\ExistingCategoryException $e){
        $this->newCategoryView->setMessageCategoryExist();
      }catch(\model\ProblemWithDatabaseException $e){
        $this->newCategoryView->setMessageProblemWithDatabase();
      }
    }
  }
}
