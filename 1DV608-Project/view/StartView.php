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
            <h1>Mi Ritzens Galleri</h1>
            <div id="loginLink">'. $this->renderLink() .'</div>

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

}
