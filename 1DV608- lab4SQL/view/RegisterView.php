<?php
namespace view;
require_once('model/RegistrationCredentials.php');

class RegisterView{

  private static $registerurl = '?register';
  private static $inUrl = 'register';
  private static $Message = 'RegisterView::Message';
  private static $username = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
  private static $passwordRepeat = 'RegisterView::PasswordRepeat';
  private static $register = 'RegisterView::Register';

  private $messageOut = '';
  private $registrationFailed = false;
  private $registrationCredOK = false;
  private $RegisterNewUser = false;
  private $savedusername = '';

  public function renderLink(){
    //om vi ahr klickat skcila tillbaka back to start
    if($this->checkRegisterNew()){
      return '<a href="?">Back to login</a>';
    }
    return '<a href='. self::$registerurl .'>Register a new user</a>';
  }

	public function checkRegisterNew(){
			return isset($_GET[self::$inUrl]);
	}
  public function checkDoRegistration(){
			return isset($_POST[self::$register]);
	}

  public function GetRegistrationCredOK(){
    return $this->registrationCredOK;
  }
  


  public function checkRegistrationCredentials(){
  $this->savedusername = $_POST[self::$username];
    try{
      $rc = new \model\RegistrationCredentials($_POST[self::$username], $_POST[self::$password], $_POST[self::$passwordRepeat]);
      $this->registrationCredOK = true;
      return $rc;
    }catch(\model\RegisterNameMissingException $e){
        $this->registrationFailed = true;
        $this->messageOut = 'Username has too few characters, at least 3 characters.';
    }catch(\model\RegisterPasswordMissingException $e){
        $this->registrationFailed = true;
        $this->messageOut = 'Password has too few characters, at least 6 characters.';
    }catch(\model\RegisterUsernameAndPasswordMissingException $e){
      $this->registrationFailed = true;
      $this->messageOut = 'Username has too few characters, at least 3 characters.<br>Password has too few characters, at least 6 characters.';
    }catch(\model\ContainsInvalidCharException $e){
      $this->registrationFailed = true;
      $this->messageOut = 'Username contains invalid characters.';
      $this->savedusername = strip_tags($_POST[self::$username]);
    }
  }


  //messages
  public function DifferentPasswords(){
    $this->registrationFailed = true;
    $this->messageOut = 'Passwords do not match.';
  }
  public function ExistingUser(){
    $this->registrationFailed = true;
    $this->messageOut = 'User exists, pick another username.';
  }


//HTML
  public function generateRegistrationHTML(){
    return '
    <h2>Register new user</h2>
      <form method="post" >
        <fieldset>
          <legend>Register a new user - Write username and password</legend>
          <p id="'. self::$Message .'">'. $this->messageOut .'</p>
					<label for="'. self::$username .'" >Username :</label>
					<input type="text" size="20" name='. self::$username .' id='. self::$username .' value="' . $this->savedusername . '" />
					<br/>
					<label for="'. self::$password .'" >Password  :</label>
					<input type="password" size="20" name="'. self::$password .'" id="'. self::$password .'" value="" />
					<br/>
					<label for="'. self::$passwordRepeat .'" >Repeat password  :</label>
					<input type="password" size="20" name="'. self::$passwordRepeat .'" id="'. self::$passwordRepeat .'" value="" />
					<br/>
					<input id="submit" type="submit" name="'. self::$register .'"  value="Register" />
					<br/>
        </fieldset>
      </form>
    ';
  }

}
 ?>
