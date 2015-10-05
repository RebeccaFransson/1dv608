<?php
namespace view;
class RegisterView extends \model\RegisterListener{

  private static $registerurl = '?register';
  private static $register = 'register';
  private static $message = 'RegisterView::Message';
  private static $username = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
  private static $passwordRepeat = 'RegisterView::PasswordRepeat';
  private static $doRegistration = 'RegisterView::DoRegistration';

  public function renderLink(){
    //om vi ahr klickat skcila tillbaka back to start
    if($this->checkRegisterNew()){
      return '<a href="?">Back to login</a>';
    }
    return '<a href='. self::$registerurl .'>Register a new user</a>';
  }

	public function checkRegisterNew(){
			if(isset($_GET[self::$register])){
				return true;
			}
			return false;
	}

  public function generateRegistration(){
    return '
    <h2>Register new user</h2>
      <form method="post" >
        <fieldset>
          <legend>Register a new user - Write username and password</legend>
          <p id="'. self::$message .'"></p>
					<label for="'. self::$username .'" >Username :</label>
					<input type="text" size="20" name='. self::$username .' id='. self::$username .' value="" />
					<br/>
					<label for="'. self::$password .'" >Password  :</label>
					<input type="password" size="20" name="'. self::$password .'" id="'. self::$password .'" value="" />
					<br/>
					<label for="'. self::$passwordRepeat .'" >Repeat password  :</label>
					<input type="password" size="20" name="'. self::$passwordRepeat .'" id="'. self::$passwordRepeat .'" value="" />
					<br/>
					<input id="submit" type="submit" name="'. self::$doRegistration .'"  value="Register" />
					<br/>
        </fieldset>
      </form>
    ';
  }

}
 ?>
