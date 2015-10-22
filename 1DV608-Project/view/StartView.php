<?php
namespace view;
class StartView{
  private static $loginURL = '?login';
  private static $contactURL = '?contact';
  private static $infoURL = '?information';

  public function __construct($IsLoggedIn){
    $this->IsLoggedIn = $IsLoggedIn;
  }

  public function renderLayout($show){
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <link rel="stylesheet" type="text/css" href="style.css">
          <title>Mi Ritzen</title>
        </head>
        <body>
          <div id="bodyAll">
          <div id="loginLink">'. $this->renderLink() .'</div>
            <div id="header"></div>
            <div id="navigation">'. $this->renderNavigation() .'</div>


            <div id="container">
                ' . $show . '
            </div>
          </div>
        </body>
      </html>
    ';
  }

  private function renderLink(){
    if($this->IsLoggedIn){
      return '<a href="?logout">Logout</a>   <a href='. self::$loginURL .'>Login Page</a>';
    }else{
      return '<a href='. self::$loginURL .'>Admin login</a>';
    }
  }
  private function renderNavigation(){
    return '<ul><li><a href="'. self::$infoURL .'">Mi Ritzen</a></li>
    <li><a href="?">Kategorier</a></li>
    <li><a href="'.self::$contactURL.'">Kontakt</a></li></ul>';
  }

}
