<?php


class LayoutView {
//controller\LoginController
  public function render($l, $c, LoginView $v, DateTimeView $dtv) {
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
          ' . $this->renderIsLoggedIn($l, $c) . '

          <div class="container">
              ' . $v->response() . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }


  private function renderIsLoggedIn($l, $c) {
    //kanske kolla om allt är kalr innan man hämtar?
    /*$isLoggedIn = $l->getIsLoggedIn();
    echo "i login: ";var_dump($isLoggedIn);*/
    $isLoggedInC = $c->getIsLoggedInC();
    echo "<br>i controller: ";var_dump($isLoggedInC);
    echo "<br>hämtar inlogg ";var_dump($isLoggedInC);

      if ($isLoggedInC) {
        return '<h2>Logged in</h2>';
      }
      else {
        return '<h2>Not logged in</h2>';
      }
  //  }

  }
}
