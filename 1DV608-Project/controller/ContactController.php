<?php
namespace controller;
class ContactController{
  public function __construct($contactModel, $contactView){
    $this->contactModel = $contactModel;
    $this->contactView = $contactView;
  }
  public function startContactPage(){
    if($this->contactView->checkSendButton()){
      //en till ifsats för i denna funktionen sätter jag namnen i formuläret så användaren slipper skriva om
      if(!$this->contactView->checkInputsMissing()){
        $this->contactModel->sendNewEmail($this->contactView->getInputValues());
      }
    }
  }
}
