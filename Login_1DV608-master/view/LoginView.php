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


//construktor
public function __construct($l, $s){
	$this->Login = $l;
	$this->Session = $s;
}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */



	 //retunerar tre/false om login
 	public function checkLoginPost(){
		//var_dump($_POST);
 		if(isset($_POST[self::$login])){// eller "count($_POST)>0"
 			return true;
 		}
 		return false;
 	}
	 //kollar om användaren har klickat på knappen,
	 //skickar namn och lösenord tillbaka
	public function getInputs() {
			$inputs = array(
				"username" => $_POST[self::$name],
    		"password" => $_POST[self::$password]);
			return $inputs;
	}



	public function response() {
		//om vi fått en post, hämta errormeddelanet
		if($this->checkLoginPost()){
			$message = $this->Login->getErrorMessage();
		}else {
			$message = '';
		}
		//om vi fått en tillbaka att vi ska spara användarnamnet
		if($this->Login->getSaveUsername()){
			$savedUsername = $_POST[self::$name];
		}else {
			$savedUsername = '';
		}
		//generera ut form
		$response = $this->generateLoginFormHTML($message, $savedUsername);
		//Om användaren loggade in, generera ut inlogg
		if($this->Login->getIsLoggedIn()){
			$response = $this->generateLogoutButtonHTML('Welcome');

			//spara session
			$inputs = $this->getInputs();
			if(!isset($_SESSION["username"])){
				$this->Session->storeSession($inputs);
			}

			//om användaren loggar ut förstör sessionen
			if(isset($_POST[self::$logout])){
				//stänger sessionen ch tar upp LoginForm igen
				$this->Session->destroySession();
				$response = $this->generateLoginFormHTML($message, $savedUsername);
				//ändra "logged in" och "not logged in" finns i controllern
			}
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
