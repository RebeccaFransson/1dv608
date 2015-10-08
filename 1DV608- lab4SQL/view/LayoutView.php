<?php
namespace view;
class LayoutView {
  private static $registerUrl = 'register';
  private static $newUserUrl = 'newuser=';

  public function __construct(\model\Login $l, LoginView $v, DateTimeView $dtv, RegisterView $rv){
    $this->Login = $l;
    $this->LoginView = $v;
    $this->DateTimeView = $dtv;
    $this->RegisterView = $rv;
	}


	public function checkURL(){
    var_dump($_GET);
    if(isset($_GET[self::$registerUrl])){
      return 'register';
    /*}else if(isset($_GET[self::$newUserUrl])){
      return 'newuser';*/
    }else{
      return 'login';
    }
	}

  public function render($form) {
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
              ' . $this->renderForm($form) . '
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
  private function renderForm($form){
    //false = register
    //true = login
    if(!$form){
      return $this->RegisterView->generateRegistrationHTML();
    }else if($form){
      return $this->LoginView->response();
    }

  }
}
