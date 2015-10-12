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
          <title>Login Example</title>
        </head>
        <body>
          <h1>Mi Ritzens Galleri</h1>
          '. $this->renderLink() .'

          <div class="container">
              ' . $show . '
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
