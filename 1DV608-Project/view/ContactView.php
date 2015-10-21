<?php
namespace view;
require_once('model/EmailObject.php');

class ContactView{
  private static $firstName = 'ContactView::Firstname';
  private static $lastName = 'ContactView::Lastname';
  private static $emailAdress = 'ContactView::EmailAdress';
  private static $clientMessage = 'ContactView::KlientMessage';
  private static $sendButton = 'ContactView::Send';

  private $errorMessage = '';
  private $firstnameValue = '';
  private $lastnameValue = '';
  private $emailAdressValue = '';
  private $clientMessageValue = '';

  private $validationOK = false;
  private $emailSent = false;

public function contactRender(){
  $response = '';
  if($this->emailSent){
    $response = '<h1>Thank you for you mail!</h1>';
  }
  $response .= $this->contactHTML();
  return $response;
}

  private function contactHTML(){
    return '
      <form method="post" >
        <fieldset>
          <legend>Contact - Write a email to Mi Ritzen</legend>
          <div class="FirstInputs">
          <p class="errorMessage">' . $this->errorMessage . '</p>
          <p><label for="' . self::$firstName . '">Firstname</label>
          <input type="text" name="' . self::$firstName . '" value="'. $this->firstnameValue .'" /></p>
          <p><label for="' . self::$lastName . '">Lastname</label>
          <input type="text" name="' . self::$lastName . '" value="'. $this->lastnameValue .'" /></p>
          <p><label for="' . self::$emailAdress . '">Email adress</label>
          <input type="text" name="' . self::$emailAdress . '" value="'. $this->emailAdressValue .'" /></p>
          </div>
          <p class="klientMessage"><label for="' . self::$clientMessage . '">Your message</label>
          <textarea rows="4" cols="30" name="' . self::$clientMessage . '" value="'. $this->clientMessageValue .'" /></textarea>
          <br>
          <input type="submit" name="' . self::$sendButton . '" value="Send" /></p>
        </fieldset>
      </form>
    ';
  }

  public function checkSendButton(){
    return isset($_POST[self::$sendButton]);
  }

  public function getAndCheckAllInputs(){
    $this->setFields();
    try{
      $emailObj = new \model\EmailObject($_POST[self::$firstName],$_POST[self::$lastName],$_POST[self::$emailAdress],$_POST[self::$clientMessage]);
      $this->validationOK = true;
      return $emailObj;
    }catch(\model\FirstnameMissingException $e){
      $this->errorMessage = 'Firstname is missing!';
    }catch(\model\LastnameMissingException $e){
      $this->errorMessage = 'Lastname is missing!';
    }catch(\model\EmailAdressMissingException $e){
      $this->errorMessage = 'Email adress is missing!';
    }catch(\model\ClientMessageMissingException $e){
      $this->errorMessage = 'Write a message!';
    }catch(\model\NotValidEmailException $e){
      $this->errorMessage = 'The email you wrote isnt valid, try again!';
    }catch(\model\NotValidNameException $e){
      $this->errorMessage = 'Your name can only be letters';
    }
  }

private function setFields(){
  $this->firstnameValue = $_POST[self::$firstName];
  $this->lastnameValue = $_POST[self::$lastName];
  $this->emailAdressValue = $_POST[self::$emailAdress];
  $this->clientMessageValue = $_POST[self::$clientMessage];
}
public function setEmailSent(){
  $this->emailSent = true;
}

//SETTERS
public function getValidationOK(){
  return $this->validationOK;
}


}
