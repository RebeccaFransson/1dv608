<?php
namespace model;
class RegisterNameMissingException extends \Exception {};
class RegisterPasswordMissingException extends \Exception {};
class RegisterUsernameAndPasswordMissingException extends \Exception {};

class RegistrationCredentials {
  //här ska v sedan hämta listan från databasen typ
	private $username;
	private $password;
  private $repeatPassword;

	public function __construct($usernameInput, $passwordInput, $repeatPasswordInput) {
    if (strlen($usernameInput) < 3 && strlen($passwordInput) < 6)
      throw new RegisterUsernameAndPasswordMissingException();
		if (strlen($usernameInput) < 3)
			throw new RegisterNameMissingException();
		if (strlen($passwordInput) < 6)
			throw new RegisterPasswordMissingException();

		$this->username = $usernameInput;
		$this->password = $passwordInput;
    $this->repeatPassword = $repeatPasswordInput;
	}
  public function getUsername(){
    return $this->username;
  }
  public function getPassword(){
    return $this->password;
  }
  public function getRepeatPassword(){
    return $this->repeatPassword;
  }

}
