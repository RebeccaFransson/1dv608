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
	//public $loggedOut = false;
	private $message = '';
	private $savedUsername = '';
	private $LoginFailed = false;
	private $LoginSuccess = false;
	private $UserCredOK = false;
	private $NotCorrectCredentials = false;
	private $urlnewusersetted = false;
//construktor
public function __construct(\model\Login $l){
	$this->Login = $l;
}

//fått en post om inlogg?
 	public function checkLoginPost(){
 		if(isset($_POST[self::$login])){// eller "count($_POST)>0"
 			return true;
 		}
 		return false;
 	}
//fått en post om utlogg?
	public function checkLogOut(){
			if(isset($_POST[self::$logout])){
				return true;
			}
			return false;
	}


	//är username och password ej tomma?
	public function checkUsercredentials(){
			try{
				 $us = new \model\UserCredentials($_POST[self::$name], $_POST[self::$password]);
				 $this->SetUserCredOK();
				 return $us;
			}catch(\model\NameMissingException $e){
				$this->SetLoginFailed();
				$this->message = 'Username is missing';
			}catch(\model\PasswordMissingException $e){
				$this->SetLoginFailed();
				$this->message = 'Password is missing';
			}
	}

	public function SetUserCredOK(){
    $this->UserCredOK = true;
  }
	public function GetUserCredOK(){
    return $this->UserCredOK;
  }
	public function SetLoginFailed(){
    $this->LoginFailed = true;
  }
  public function SetLoginSuccess(){
    $this->LoginSuccess = true;
		$this->message = 'Welcome';
  }
	public function NotCorrectCredentials(){
    $this->NotCorrectCredentials = true;
		$this->message = 'Wrong name or password';
  }
	public function setGoodbyeMessage(){
			 $this->message = "Bye bye!";
	}
	public function setNewUserURL(){
			 if($this->urlnewusersetted){
				 $this->urlnewusersetted = false;
			 }
			 $this->urlnewusersetted = true;
	}
	public function getNewUserURL(){
		return $this->urlnewusersetted = true;
	}
	public function getNewUserURLUsername(){
			 $this->message = "Registered new user";
			 $this->savedUsername = $_GET[self::$urlnewuser];
	}

//skriver ut html-kod om man loggad in eller om inloggningen misslyckades
	public function response() {

			var_dump($this->getNewUserURL());
		//kolla om inloggad med "precis inloggad" eller sessions
		if($this->Login->getIsLoggedIn()){
			//...inloggad!
			$this->savedUsername = $_POST[self::$name];
			$response = $this->generateLogoutButtonHTML($this->message);
		}else if($this->urlnewusersetted){
			$this->getNewUserURLUsername();
			$response = $this->generateLoginFormHTML($this->message, $this->savedUsername);
			$this->setNewUserURL();
		}else{
			$response = $this->generateLoginFormHTML($this->message, $this->savedUsername);
		}
		return $response;
	}
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
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
