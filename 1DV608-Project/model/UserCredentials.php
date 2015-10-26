<?php
namespace model;
class NameMissingException extends \Exception {};
class PasswordMissingException extends \Exception {};

class UserCredentials {
	private $username;
	private $password;
/*
Skapar ett object med användar uppgifterna och validerar dessa inputsen
*/
	public function __construct($usernameInput, $passwordInput) {
		if (is_string($usernameInput) == false || strlen($usernameInput) == 0)
			throw new NameMissingException();
		if (is_string($passwordInput) == false || strlen($passwordInput) == 0)
			throw new PasswordMissingException();

		$this->username = $usernameInput;
		$this->password = $passwordInput;
	}

  public function getUsername(){
    return $this->username;
  }
  public function getPassword(){
    return $this->password;
  }
}
