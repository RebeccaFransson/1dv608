<?php
namespace view;

class changeGalleryView{
  private static $messageId = 'LoginView::Message';
  private static $sendImg = 'LoginView::SendIMG';

  private $message = '';

  public function changeGalleryResponse(){
    $response = $this->changeGalleryHTML($this->message);
    return $response;
  }
  public function getAllCategories(){
    return '
    <p>Välj en kategori</p>
      <select>
        <option>Natur</option>
        <option>Människor</option>
        <option>Hästar</option>
      </select>
    ';
  }
  public function changeGalleryHTML($message){
    return '
    <form method="post" >
      <fieldset>
        <legend>Lägg till bild</legend>
        <p id="' . self::$messageId . '">' . $message . '</p>
        <input type="file" value="Välj bild">
        '. $this->getAllCategories() .'
        <input type="submit" name="' . self::$sendImg . '" value="Ladda upp" />
      </fieldset>
    </form>
    ';
  }
}
