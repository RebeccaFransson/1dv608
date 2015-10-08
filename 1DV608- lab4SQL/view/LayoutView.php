<?php
namespace view;
class LayoutView {
  private static $registerUrl = 'register';
  private static $LoginrUrl = '';
  private static $LoginrUrl2 = '?';

  public function __construct(\model\Login $l, LoginView $v, DateTimeView $dtv, RegisterView $rv){
    $this->Login = $l;
    $this->LoginView = $v;
    $this->DateTimeView = $dtv;
    $this->RegisterView = $rv;
	}


	public function checkURL(){
    var_dump($_GET);
    if($_GET[self::$registerUrl]){
      return 'register';
    }else if($_GET[self::$LoginrUrl] || $_GET[self::$LoginrUrl2]){
      return 'login';
    }else{
      return $_GET;
    }
	}

  public function render() {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->RegisterView->renderLink() . '

          ' . $this->renderIsLoggedIn() . '
          <div class="container">
              ' . $this->renderForm() . '
              ' . $this->DateTimeView->show() . '
          </div>
         </body>
      </html>
    ';
  }
  private function renderIsLoggedIn() {
    //inloggade?
    $isLoggedIn = $this->Login->getIsLoggedIn();
      if ($isLoggedIn) {
        return '<h2>Logged in</h2>';
      }
      else {
        return '<h2>Not logged in</h2>';
      }
  }
  private function renderForm(){
    $wantsToRegister = $this->RegisterView->checkRegisterNew();
    if($wantsToRegister){
      return $this->RegisterView->generateRegistrationHTML();
    }
    return $this->LoginView->response();
  }
}
