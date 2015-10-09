<?php
namespace view;
require_once('model/LoginListener.php');
require_once('model/UserCredentials.php');

class LoginView extends \model\LoginListener{
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $newUser = 'LoginView::RegisterNewUser';
	private static $messageId = 'LoginView::Message';
	private static $urlnewuser = 'newuser';
	private static $usernameSession = 'Login::username';
	//public $loggedOut = false;
	private $message = '';
	private $savedUsername = '';
	private $UserCredOK = false;
	
//construktor
public function __construct($IsLoggedIn){
	$this->IsLoggedIn = $IsLoggedIn;
}

//fått en post om inlogg?
 	public function checkLoginPost(){
 		return isset($_POST[self::$login]);
 	}
//fått en post om utlogg?
	public function checkLogOut(){
			return isset($_POST[self::$logout]);
	}
	//är username och password ej tomma?
	public function checkUsercredentials(){
			try{
				 $us = new \model\UserCredentials($_POST[self::$name], $_POST[self::$password]);
				 $this->UserCredOK = true;
				 return $us;
			}catch(\model\NameMissingException $e){
				$this->IsLoggedIn = false;
				$this->message = 'Username is missing';
			}catch(\model\PasswordMissingException $e){
				$this->IsLoggedIn = false;
				$this->message = 'Password is missing';
			}
	}

	public function GetUserCredOK(){//används i Logincontrollern
    return $this->UserCredOK;
  }
  public function SetLoginSuccess(){
    $this->IsLoggedIn = true;
		$this->message = 'Welcome';
  }
	public function NotCorrectCredentials(){
		$this->IsLoggedIn = false;
		$this->message = 'Wrong name or password';
  }
	public function setGoodbyeMessage(){
		$this->IsLoggedIn = false;
		$this->message = "Bye bye!";
	}
	public function setSessionName(){
		$this->savedUsername = $_SESSION[self::$usernameSession];
	 	$this->message = 'Registered new user.';
	}

//skriver ut html-kod om man loggad in eller om inloggningen misslyckades
	public function LoginResponse() {
		//inloggad
		if($this->IsLoggedIn){
			$response = $this->generateLogoutButtonHTML($this->message);
			unset($_SESSION[self::$usernameSession]);
		//skapat ny användare
		}else if($_SESSION[self::$usernameSession]){
			$this->setSessionName();
			$response = $this->generateLoginFormHTML($this->message, $this->savedUsername);
		//utloggad
		}else{
			$this->savedUsername = $_POST[self::$name];
			$response = $this->generateLoginFormHTML($this->message, $this->savedUsername);
		}
		return $response;
	}

	//genererar ut sidan när amn är inloggad
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	//genererar ut inloggs-formulär
	private function generateLoginFormHTML($message, $savedUsername) {
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
