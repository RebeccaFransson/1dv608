<?php
namespace view;
require_once('model/UserCredentials.php');

class LoginView{
  private static $messageId = 'LoginView::Message';
  private static $name = 'LoginView::UserName';
  private static $password = 'LoginView::Password';
  private static $login = 'LoginView::Login';

  private $message = '';
  private $savedUsername = '';
  private $userCredOK = false;

  public function __construct($sessions){
    $this->sessions = $sessions;
  }
//BEroende på om användaren är inloggad eller inte skriv anting inlogg-sidan ut eller en lista med admin-alternativ
  public function loginResponse(){
    $response = '';
    if($this->sessions->checkSessionLoggedIn()){
      $response = '<p class="links"><a href="?changeGallery">Upload images</a><br>
      <a href="?">Delete images(not done)</a><br>
      <a href="?">Add new admin(not done)</a><br></p>';
    }else{
      $response = $this->LoginHTML();
    }
    return $response;
  }

  public function loginHTML(){
    return '
    <p class="errorMessage">' . $this->message . '</p>
    <form method="post" >
      <fieldset>
        <legend>Login - enter Username and password</legend>
        <p><input type="text" placeholder="Username" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->savedUsername . '" /></p>
        <p><input type="password" placeholder="Password" id="' . self::$password . '" name="' . self::$password . '" /></p>
        <p><input type="submit" name="' . self::$login . '" value="login" /></p>
      </fieldset>
    </form>
    ';
  }

  public function checkLoginButton(){
    return isset($_POST[self::$login]);
  }
  public function checkUserCredentials(){
    $this->savedUsername = $_POST[self::$name];
    try{
				 $us = new \model\UserCredentials($_POST[self::$name], $_POST[self::$password]);
				 $this->userCredOK = true;
				 return $us;
			}catch(\model\NameMissingException $e){
				//$this->IsLoggedIn = false;
				$this->message = 'Username is missing!';
			}catch(\model\PasswordMissingException $e){
				//$this->IsLoggedIn = false;
				$this->message = 'Password is missing!';
			}
  }
  public function notCorrectCredentials(){
    $this->message = 'Not correct credentials!';
  }
  public function successLogin(){//kontrollern pratar med denna vyn som sedan säger till sessions classen
    $this->sessions->setSessionLoggedIn();
  }
  //GETTERS
  public function getUserCredOK(){
    return $this->userCredOK;
  }

}
