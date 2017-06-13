<?php
require_once('db_credentials.php');
/**
 *
 */
class Model
{
  protected $conn;
  public function connect(){
    $db_engine = DATABASE_ENGINE;
    $db_host = DATABASE_HOST;
    $db_name = DATABASE;
    $password = PASSWORD;
    $user = USER;
    $dsn = sprintf("%s:host=%s;dbname=%s", $db_engine, $db_host, $db_name);
    try
    {
      $this->conn = new PDO($dsn, $user, $password);
    }
    catch (PDOException $e)
    {
      echo 'Database connection problem. ' . $e->getMessage();
    }
    return $this->conn;
  }
}
?>
