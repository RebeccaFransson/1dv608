<?php
namespace model;

class ContactModel{
  private $emailTo = 'ymafransson@gmail.com';
  private $emailFrom;
  private $subject = 'A message from websurfer on your site';
  private $message;
  private $headers;

  public function sendNewEmail($emailObj){
    $this->emailFrom = $emailObj->getEmailAdress();
    $this->message = $emailObj->getClientMessage();
    $this->headers = 'From: '.$this->emailFrom;

    mail($this->emailTo, $this->subject, $this->message, $this->headers);


    echo "nu sänder vi emailet allt gick bra ";

  }

}
