<?php
namespace view;
class ContactView{
  private static $firstName = 'ContactView::Firstname';
  private static $lastName = 'ContactView::Lastname';
  private static $emailAdress = 'ContactView::EmailAdress';
  private static $klientMessage = 'ContactView::KlientMessage';
  private static $sendButton = 'ContactView::Send';

  private $errorMessage = '';
  private $firstnameValue = '';
  private $lastnameValue = '';
  private $emailAdressValue = '';
  private $klientMessageValue = '';



  public function contactHTML(){
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
          <p class="klientMessage"><label for="' . self::$klientMessage . '">Your message</label>
          <textarea rows="4" cols="30" name="' . self::$klientMessage . '" value="'. $this->klientMessageValue .'" /></textarea>
          <br>
          <input type="submit" name="' . self::$sendButton . '" value="Send" /></p>
        </fieldset>
      </form>
    ';
  }

  public function checkSendButton(){
    return isset($_POST[self::$sendButton]);
  }

  public function checkInputsMissing(){
    $this->setFields();
    if(is_string($_POST[self::$firstName]) == false || strlen($_POST[self::$firstName]) == 0){
      $this->errorMessage = 'Firstname is missing!';
      return true;
    }else if(is_string($_POST[self::$lastName]) == false || strlen($_POST[self::$lastName]) == 0){
      $this->errorMessage = 'Lastname is missing!';
      return true;
    }else if(is_string($_POST[self::$emailAdress]) == false || strlen($_POST[self::$emailAdress]) == 0){
      $this->errorMessage = 'Email adress is missing!';
      return true;
    }else if(is_string($_POST[self::$klientMessage]) == false || strlen($_POST[self::$klientMessage]) == 0){
      $this->errorMessage = 'You need to write a message!';
      return true;
    }else{
      return false;
    }
  }
private function setFields(){
  $this->firstnameValue = $_POST[self::$firstName];
  $this->lastnameValue = $_POST[self::$lastName];
  $this->emailAdressValue = $_POST[self::$emailAdress];
  $this->klientMessageValue = $_POST[self::$klientMessage];
}

//GETTERS
public function getInputValues(){
    return $arrayName = array(
      'Firstname' => $_POST[self::$firstName],
      'Lastname' => $_POST[self::$lastName],
      'EmailAdress' => $_POST[self::$emailAdress],
      'KlientMessage' => $_POST[self::$klientMessage],
   );
}


}
