<?php

namespace model;
class UsersDAL{

  private static $table = "Users";

  public function __construct(\mysqli $db){
    $this->database = $db;

  }

}


?>
