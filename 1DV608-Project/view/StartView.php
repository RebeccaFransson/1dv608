<?php
namespace view;
class StartView{
  private static $loginURL = '?login';

  public function __construct($toGalleryLink){
    $this->toGalleryLink = $toGalleryLink;
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
            <div id="header"><div id="loginLink">'. $this->renderLink() .'</div></div>
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
    if($this->toGalleryLink){
      return '<a href="?">Back to Gallery</a>';
    }else{
      return '<a href='. self::$loginURL .'>Admin login</a>';
    }
  }
  private function renderNavigation(){
    return '<ul><li><a href="#">Mi Ritzen</a></li>
    <li><a href="#">Kategorier</a><ul>
      <li><a href="#">Nature</a></li>
      <li><a href="#">People</a></li>
      </ul></li>
    <li><a href="#">Kontakt</a></li></ul>';
  }

}
