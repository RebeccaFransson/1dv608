<?php
namespace controller;
class ContactController{

  public function __construct(\model\ContactModel $contactModel, \view\ContactView $contactView){
    $this->contactModel = $contactModel;
    $this->contactView = $contactView;
  }
/*
Väntar på att användaren skall klicka på en skcika-knapp
Validerar alla inputfälten
Om valideringen gått bra så skickas emailet
Ber vyn att sätta ett meddelande till användaren om att emailet har skickats
*/
  public function startContactPage(){
    if($this->contactView->checkSendButton()){
      $emailObj = $this->contactView->getAndCheckAllInputs();
      if($this->contactView->getValidationOK()){
        if($this->contactModel->sendNewEmail($emailObj)){
          $this->contactView->setEmailSent();
        }
      }
    }
  }
}
