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

  public function __construct($loginModel){
    $this->loginModel = $loginModel;
  }

  public function loginResponse(){
    $response = $this->LoginHTML();
    return $response;
  }

  public function loginHTML(){
    return '
    <form method="post" >
      <fieldset>
        <legend>Login - enter Username and password</legend>
        <p id="' . self::$messageId . '">' . $this->message . '</p>
        <label for="' . self::$name . '">Username</label>
        <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->savedUsername . '" />
        <label for="' . self::$password . '">Password  </label>
        <input type="password" id="' . self::$password . '" name="' . self::$password . '" />
        <input type="submit" name="' . self::$login . '" value="login" />
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
				$this->message = 'Username is missing';
			}catch(\model\PasswordMissingException $e){
				//$this->IsLoggedIn = false;
				$this->message = 'Password is missing';
			}
  }

  //GETTERS
  public function getUserCredOK(){
    return $this->userCredOK;
  }

}
