<?php
namespace model;

class ContactModel{
  private $emailTo = 'rf222cz@student.lnu.se';
  private $emailFrom;
  private $subject = 'A message from websurfer on your site';
  private $headers;
/*
FUNGERAR EJ!!!
Lyckades inte hinna fixa min server till en mail-server
därför fungerar inte det att skciak ett mail.
Men all validering innan denna funktionen fungerar perfekt!
*/
  public function sendNewEmail($emailObj){
    $this->emailFrom = $emailObj->getEmailAdress();
    $this->headers = 'From: '.$this->emailFrom.' Name: '.$emailObj->getFirstname().$emailObj->getLastname();

    if(@mail($this->emailTo, $this->subject, $emailObj->getClientMessage())){
      //echo "message sent";
    }else{
      //echo "error!";
      //print_r(error_get_last());
    }
    //header('Location: http://188.166.116.158/1dv608/Project-Gallery/?contact');
    return true;
  }

}
