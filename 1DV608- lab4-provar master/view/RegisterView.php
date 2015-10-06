<?php
namespace view;
require_once('model/RegisterListener.php');
require_once('model/RegistrationCredentials.php');

class RegisterView extends \model\RegisterListener{

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

  public function SetRegistrationFailed(){
    $this->registrationFailed = true;
  }
  public function SetRegistrationSuccess(){

  }
  public function GetRegistrationFailed(){
    return $this->registrationFailed;
  }
  public function GetRegistrationCredOK(){
    return $this->registrationCredOK;
  }

  public function checkRegistrationCredentials(){
    try{
      $rc = new \model\RegistrationCredentials($_POST[self::$username], $_POST[self::$password], $_POST[self::$passwordRepeat]);
      $this->registrationCredOK = true;
      return $rc;
    }catch(\model\RegisterNameMissingException $e){
        $this->SetRegistrationFailed();
        $this->messageOut = 'Username has too few characters, at least 3 characters.';
    }catch(\model\RegisterPasswordMissingException $e){
        $this->SetRegistrationFailed();
        $this->messageOut = 'Password has too few characters, at least 6 characters.';
    }catch(\model\RegisterUsernameAndPasswordMissingException $e){
      $this->SetRegistrationFailed();
      $this->messageOut = 'Username has too few characters, at least 3 characters.<br>Password has too few characters, at least 6 characters.';
  }
  }
  public function DifferentPasswords(){
    $this->messageOut = 'Passwords do not match.';
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
					<input type="text" size="20" name='. self::$username .' id='. self::$username .' value="' . $_POST[self::$username] . '" />
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
