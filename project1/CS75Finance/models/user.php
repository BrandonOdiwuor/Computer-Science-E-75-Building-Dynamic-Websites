<?php
require_once('model.php');
/**
 *
 */
class User extends Model
{

  public function __construct()
  {
    $this->connect();
  }

  public function sign_up($email, $first_name, $surname, $password, $balance)
  {
    $sql = 'INSERT INTO users (email, first_name, surname, password, balance) ';
    $sql .= 'VALUES(:email, :first_name, :surname, :password, :balance)';
    try
    {
      $stmt = $this->conn->prepare($sql);
      if($stmt)
      {
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':surname', $surname);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':balance', $balance);
        $stmt->execute();
      }
    }
    catch (PDOException $e)
    {
      echo 'Statement preparation error. ' . $e->getMessage();
      exit();
    }
    return true;
  }

  public function sign_in($email, $password)
  {
    $sql = 'SELECT password FROM users WHERE email=:email';
    try
    {
      $stmt = $this->conn->prepare($sql);
      if($stmt)
      {
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch();
        $password_hash = $result['password'];
        if(password_verify($password, $password_hash))
        {
          return true;
        }
        else
        {
          return false;
        }
      }
    }
    catch (PDOException $e)
    {
      echo 'Statement preparation error. ' . $e->getMessage();
      exit();
    }
  }

  public function email_exists($email)
  {
    $sql = 'SELECT COUNT(email) FROM users WHERE email=:email';
    try
    {
      $stmt = $this->conn->prepare($sql);
      if($stmt)
      {
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result[0] == 1)
        {
          return true;
        }
        else
        {
          return false;
        }
      }
    }
    catch (PDOException $e)
    {
      echo 'Statement preparation error. ' . $e->getMessage();
      exit();
    }
  }

  public function balance($id)
  {
    $sql = 'SELECT balance FROM users WHERE id=:id';
    try
    {
      $stmt = $this->conn->prepare($sql);
      if($stmt)
      {
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $balance = $result['balance'];
      }
    }
    catch (PDOException $e)
    {
      echo 'Statement preparation error. ' . $e->getMessage();
      exit();
    }
    return $balance;
  }

  public function id($email)
  {
    $sql = 'SELECT id FROM users WHERE email=:email';
    try
    {
      $stmt = $this->conn->prepare($sql);
      if($stmt)
      {
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch();
        $id = $result['id'];
      }
    }
    catch (PDOException $e)
    {
      echo 'Statement preparation error. ' . $e->getMessage();
      exit();
    }
    return $id;
  }
}

//$user = new User();
//$user->sign_up('brandon.odiwuor@gmail.com', 'Brandon', 'Odiwuor', 'wayne721936', 10000);
//echo $user->email_exists('brandon.odiwuor@gmail.com');
//echo $user->sign_in('brandon.odiwuor@gmail.com', 'wayne721936');
//print_r($user->balance(1));
?>
