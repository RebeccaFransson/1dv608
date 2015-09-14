<?php


class LayoutView {

  public function render(controller\LoginController $c, LoginView $v, DateTimeView $dtv) {
    //if islogged in, som man hämtar från controllern
    //var_dump($isLoggedIn);
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($c) . '

          <div class="container">
              ' . $v->response() . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }

  private function renderIsLoggedIn($c) {
    $isLoggedIn = $c->getIsLoggedIn();
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}
