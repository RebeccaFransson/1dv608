<?php
namespace model;
class NotCorrectCredentialsException extends \Exception {};
class ProblemWithDatabaseException extends \Exception {};
class ExistingImageException extends \Exception {};
class ExistingCategoryException extends \Exception {};
class NoCategorysException extends \Exception {};
class NoImagesByCategoryException extends \Exception {};
require_once('model/Image.php');

class GalleryDAL{

  private static $imgTable = "tbl_image";
  private static $categoryTable = "tbl_category";
  private static $adminTable = "Admin";
  private static $servername = "localhost";
  private static $usernameDB = "root";
  private static $passwordDB = "";
  private static $nameDB = "GalleryDB";
  private $conn;
  private $imagesArray = Array();
  private $categoryArray = Array();

//Skapar och kollar en ansluting till databasen
  public function __construct(){
    $this->conn = new \mysqli(self::$servername, self::$usernameDB, self::$passwordDB, self::$nameDB);
    if ($this->conn->connect_error) {
        die("Connection failed: " . $this->conn->connect_error);
    }
  }
/*
Hämtar alla bilderna efter vilken kategori som kommer in i funktionen
För varje bild skapas ett objekt som läggs i en arry som retuneras
*/
  public function getImagesByCategory($category){
    $sql = "SELECT image_id, image_name, image_url
    FROM tbl_image
    INNER JOIN tbl_category
    ON tbl_category.category_id=tbl_image.image_category
    WHERE tbl_category.category_name = '$category'";

    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $image = new \model\Image($row["image_id"], $row["image_name"], $row["image_url"]);
            Array_push($this->imagesArray, $image);
        }
    } else {
        throw new NoImagesByCategoryException();
    }
    return $this->imagesArray;
  }

/*
Hämtar alla kategorierna
För varje kategori läggs denna till i en array som retuneras
*/
  public function getCategorys(){
    $sql = "SELECT category_name FROM ".self::$categoryTable;
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            Array_push($this->categoryArray, $row["category_name"]);
        }
    } else {
        throw new NoCategorysException();
    }
    return $this->categoryArray;
  }

/*
Hämtar ut ID som föreställer en viss category i images-tabellen
(Funktionen finns för att underlätta min sql-sats OCH för att minska duplicerad kod)
Används i: checkExistingImage OCH uploadNewImage
*/
  private function getCategoryId($category){
    $getCategoryId = "SELECT category_id
      FROM ". self::$categoryTable ."
      WHERE tbl_category.category_name = '$category'";
      $getCategoryId = $this->conn->query($getCategoryId);
      return $getCategoryId->fetch_assoc()["category_id"];
  }

/*
Kollar om bilden redan finns i databasen för spam av uppladdning
Kollar bara om det redan finns en bild med samma namn och kategori
*/
  public function checkExistingImage($path, $category){
    $id = $this->getCategoryId($category);
    $getexist = "SELECT 1 FROM ". self::$imgTable ." WHERE image_url='$path' AND image_category='$id'";
    $query = mysqli_query($this->conn, $getexist);
    $result = mysqli_fetch_row($query);
    if ($result[0] >= 1) {
      throw new ExistingImageException();
      return false;
    }
    return true;
  }

  /*
Kollar om kategori-namnet redan finns i databasen
  */
  private function checkExistingCategory($category){
    $getexist = "SELECT 1 FROM ". self::$categoryTable ." WHERE category_name='$category'";
    $query = mysqli_query($this->conn, $getexist);
    $result = mysqli_fetch_row($query);
    if ($result[0] >= 1) {
      throw new ExistingCategoryException();
      return false;
    }
    return true;
  }

/*
Lägger till en ny kategori i databasen
*/
  public function insertNewCategory($category){
    $this->checkExistingCategory($category);
    $add = $this->conn->prepare("INSERT INTO  ". self::$categoryTable ."(category_name) VALUES ('". $category ."')");
    if ($add === FALSE) {
      throw new ProblemWithDatabaseException();
      return false;//körs ej pga exeption
    }
    $add->execute();
  }

/*
Laddar upp en ny bild till databasen
*/
  public function uploadNewImage($path, $description, $category){
    //get right category id
    $id = $this->getCategoryId($category);
      $add = $this->conn->prepare("INSERT INTO  ". self::$imgTable ."(
  			image_url , image_name, image_category)
  				VALUES (?, ?, ?)");
  		if ($add === FALSE) {
  			throw new ProblemWithDatabaseException();
        return false;//körs ej pga exeption känns bra att ha den ändå :)
  		}
  		$add->bind_param('ssi', $path, $description, $id);
  		$add->execute();
      return true;
  }

  /*
Kollar om användarnamnet och lösenordet finns tillsammans i databasen
  */
  public function tryToLoggIn($username, $password){
    $login = "SELECT * FROM  `". self::$adminTable ."` WHERE BINARY username = '$username' AND password =  '$password'";
    $query = mysqli_query($this->conn, $login);
    $result = mysqli_fetch_row($query);
    if ($result === NULL) {
      throw new NotCorrectCredentialsException();
    }
  }
}
