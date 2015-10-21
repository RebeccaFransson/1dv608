<?php
namespace model;

class ContactModel{
  private $emailTo = 'rf222cz@lnu.student.se';
  private $emailFrom;
  private $subject = 'A message from websurfer on your site';
  private $message;
  private $headers;

  public function sendNewEmail($emailObj){
    $this->emailFrom = $emailObj->getEmailAdress();
    //$this->message = $emailObj->getClientMessage();
    $this->headers = 'From: '.$this->emailFrom.' Name: '.$emailObj->getFirstname().$emailObj->getLastname();

    mail($this->emailTo, $this->subject, $emailObj->getClientMessage());

    var_dump($this->emailTo, $this->subject, $this->message, $this->headers);
    echo "nu sänder vi emailet allt gick bra ";
    return true;
  }

}
