<?php
require_once('model.php');
/**
 *
 */
class Transaction extends Model
{

  function __construct()
  {
    $this->connect();
  }

  public function transactions($user_id)
  {
    $sql = 'SELECT transaction, time, symbol,	shares, price FROM transactions ';
    $sql .= 'WHERE user_id=:user_id';
    $transactions = array();
    try
    {
      $stmt = $this->conn->prepare($sql);
      if($stmt)
      {
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        while($row = $stmt->fetch())
        {
          $transactions[] = array($row['transaction'],
                                  $row['time'],
                                  $row['symbol'],
                                  $row['shares'],
                                  $row['price']);
        }
      }
    }
    catch (Exception $e)
    {
      $this->conn->rollBack();
      echo 'Statement preparation error. ' . $e->getMessage();
      exit();
    }
    return $transactions;
  }
}

//$transaction = new Transaction;
//print_r($transaction->transactions(1));
?>
