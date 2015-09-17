<?php


class LayoutView {
//controller\LoginController
  public function render($l, $s, LoginView $v, DateTimeView $dtv) {
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
          ' . $this->renderIsLoggedIn($l, $s) . '

          <div class="container">
              ' . $v->response() . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }


  private function renderIsLoggedIn($l, $s) {
    /*$g = $v->getloggedOut();
    echo "loggat ut? ";
    var_dump($g);
    if(!$g){//om användaren loggat ut
      return '<h2>Not logged in</h2>';
    }else{//annars hämtar vi*/
    $isLoggedIn = $l->getIsLoggedIn();
    echo "hämtar inlogg";var_dump($isLoggedIn);
    if($s->getLoggedOut()){
      echo "utloggad";
      $isLoggedIn = false;
    }

      if ($isLoggedIn) {
        return '<h2>Logged in</h2>';
      }
      else {
        return '<h2>Not logged in</h2>';
      }
  //  }

  }
}
