<?php
namespace model;
class NameMissingException extends \Exception {};
class PasswordMissingException extends \Exception {};
class NoUniqueException extends \Exception {};
class NoPriceException extends \Exception {};
class UniqueURLException extends \Exception {};
  
class Product {
	private $username = 'Admin';
	private $password = 'Password';

	public function __construct($usernameInput, $passwordInput) {
		if (is_string($usernameInput) == false || strlen($usernameInput) == 0)
			throw new NameMissingException();
		if (is_string($passwordInput) == false || strlen($passwordInput) == 0)
			throw new PasswordMissingException();
		if ($usernameInput !== $this->username || $passwordInput !== $this->password)//finns ej i listan
			throw new NoUniqueException();

		if (!is_numeric($price) || $price <= 0) {
			throw new NoPriceException();
		}
		$this->title = $title;
		$this->description = $description;
		$this->price = $price;
		$this->unique = $unique;
	}
