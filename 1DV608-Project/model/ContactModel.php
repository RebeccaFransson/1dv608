<?php
namespace model;

class ContactModel{
  private $emailTo = 'rf222cz@lnu.student.se';
  private $emailFrom;
  private $subject = 'A message from websurfer on your site';
  private $headers;

  public function sendNewEmail($emailObj){
    $this->emailFrom = $emailObj->getEmailAdress();
    $this->headers = 'From: '.$this->emailFrom.' Name: '.$emailObj->getFirstname().$emailObj->getLastname();

    mail($this->emailTo, $this->subject, $emailObj->getClientMessage());
    return true;
  }

}
