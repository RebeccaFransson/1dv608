<?php
namespace view;
class LayoutView {

  public function __construct(\model\Login $l, LoginView $v, DateTimeView $dtv, RegisterView $rv){
    $this->Login = $l;
    $this->LoginView = $v;
    $this->DateTimeView = $dtv;
    $this->RegisterView = $rv;
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
      return $this->RegisterView->generateRegistration();
    }
    return $this->LoginView->response();
  }
}
