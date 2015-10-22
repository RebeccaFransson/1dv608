<?php
namespace model;

class ContactModel{
  private $emailTo = 'rf222cz@student.lnu.se';
  private $emailFrom;
  private $subject = 'A message from websurfer on your site';
  private $headers;

  public function sendNewEmail($emailObj){
    $this->emailFrom = $emailObj->getEmailAdress();
    $this->headers = 'From: '.$this->emailFrom.' Name: '.$emailObj->getFirstname().$emailObj->getLastname();

    mail($this->emailTo, $this->subject, $emailObj->getClientMessage());
    //header('Location: http://188.166.116.158/1dv608/Project-Gallery/?contact');
    return true;
  }

}
