<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	public $loggedOut = false;
	private $message = '';

//construktor
public function __construct($l){
	$this->Login = $l;
}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */

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
	}
	 //skickar namn och lösenord tillbaka
	public function getInputs() {
			$inputs = array(
				"username" => $_POST[self::$name],
    		"password" => $_POST[self::$password]);
			return $inputs;
	}

	//sätt och hämta errormeddelande
	public function setErrorMessage($getMessage){
			 $this->message = $getMessage;
	}
	public function getErrorMessage(){
			 return $this->message;
	}



//skriver ut html-kod om man loggad in eller om inloggningen misslyckades
	public function response() {
		//kolla om inloggad...
		if($this->Login->getIsLoggedIn()){
			//...inloggad!
			$response = $this->generateLogoutButtonHTML($this->getErrorMessage());
		}else{
			//...gick inte att logga in.
			//om vi fått tillbaka att vi ska spara användarnamnet
			if($this->Login->getSaveUsername()){
				$savedUsername = $_POST[self::$name];
			}else {
				$savedUsername = '';
			}
			$response = $this->generateLoginFormHTML($this->getErrorMessage(), $savedUsername);
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

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
	}

}
