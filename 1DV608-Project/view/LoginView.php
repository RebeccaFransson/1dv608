<?php
namespace view;
class LoginView{
  private static $messageId = 'LoginView::Message';
  private static $name = 'LoginView::UserName';
  private static $password = 'LoginView::Password';
  private static $login = 'LoginView::Login';

  private $message = '';

  public function LoginResponse(){
    $response = $this->LoginHTML($this->message);
    return $response;
  }

  public function LoginHTML($message){
    return '
    <form method="post" >
      <fieldset>
        <legend>Login - enter Username and password</legend>
        <p id="' . self::$messageId . '">' . $message . '</p>
        <label for="' . self::$name . '">Username :</label>
        <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $savedUsername . '" />
        <label for="' . self::$password . '">Password :</label>
        <input type="password" id="' . self::$password . '" name="' . self::$password . '" />
        <input type="submit" name="' . self::$login . '" value="login" />
      </fieldset>
    </form>
    ';
  }

}
