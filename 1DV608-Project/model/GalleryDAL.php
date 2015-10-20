<?php
namespace model;
require_once('model/Image.php');

class GalleryDAL{

  private static $imgTable = "tbl_image";
  private static $categoryTable = "tbl_category";
  private static $servername = "localhost";
  private static $usernameDB = "root";
  private static $passwordDB = "";
  private static $nameDB = "GalleryDB";
  private $conn;
  private $imagesArray = Array();
  private $categoryArray = Array();

  public function __construct(){
    $this->conn = new \mysqli(self::$servername, self::$usernameDB, self::$passwordDB, self::$nameDB);
    // Check connection
    if ($this->conn->connect_error) {
        die("Connection failed: " . $this->conn->connect_error);
    }
  }
//`
  public function getImagesByCategory($category){
    $sql = "SELECT image_id, image_name, image_url
    FROM `tbl_image`
    INNER JOIN `tbl_category`
    ON tbl_category.category_id=tbl_image.image_category
    WHERE tbl_category.category_name = '".$category."'";

    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $image = new \model\Image($row["image_id"], $row["image_name"], $row["image_url"]);
            Array_push($this->imagesArray, $image);
        }
    } else {
        echo "0 results ";//kasta exeption
    }
    return $this->imagesArray;
  }

  public function getCategorys(){
    $sql = "SELECT category_name FROM ".self::$categoryTable;
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            Array_push($this->categoryArray, $row["category_name"]);
        }
    } else {
        echo "0 results";//kasta exeption
    }
    return $this->categoryArray;
  }

  //NEW image
  public function uploadNewImage($path, $description, $category){

    //get right category id
    $getCategoryId = "SELECT image_category
      FROM `". self::$imgTable ."`
      INNER JOIN tbl_category
      ON tbl_category.category_id=tbl_image.image_category
      WHERE tbl_category.category_name = '$category'";

      $getCategoryId = $this->conn->query($getCategoryId);
      $id = $getCategoryId->fetch_assoc()["image_category"];

      $add = $this->conn->prepare("INSERT INTO  ". self::$imgTable ."(
  			image_url , image_name, image_category)
  				VALUES (?, ?, ?)");
  		if ($add === FALSE) {
  			throw new \Exception($this->conn->error);
  		}
  		$add->bind_param('ssi', $path, $description, $id);
  		$add->execute();
  }






}
