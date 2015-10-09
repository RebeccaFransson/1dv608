<?php
namespace view;
class LayoutView {
  private static $registerUrl = 'register';
  private static $newUserUrl = 'newuser=';
  private static $registerurl = '?register';

  public function __construct($isLoggedIn, $LoginResponse, DateTimeView $dtv, $RegisterHTML){
    $this->isLoggedIn = $isLoggedIn;
    $this->LoginResponse = $LoginResponse;
    $this->DateTimeView = $dtv;
    $this->RegisterHTML = $RegisterHTML;
	}

  public function renderLink(){
    //inloggade = ingen knapp | Register-knapp | back to start-knapp
    if($this->isLoggedIn){
      return '';
    }
    if(isset($_GET['register']) == true){
      return '<a href="?">Back to login</a>';
    }
    return '<a href='. self::$registerurl .'>Register a new user</a>';
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
          ' . $this->renderLink() . '

          ' . $this->renderIsLoggedInTitle() . '
          <div class="container">
              ' . $this->renderForm($form) . '
              ' . $this->DateTimeView->show() . '
          </div>
         </body>
      </html>
    ';
  }

  private function renderIsLoggedInTitle() {
      if ($this->isLoggedIn) {
        return '<h2>Logged in</h2>';
      }
      else {
        return '<h2>Not logged in</h2>';
      }
  }
  private function renderForm($form){
    //false = register || true = login
    if(!$form){
      return $this->RegisterHTML;
    }else if($form){
      return $this->LoginResponse;
    }

  }
}
