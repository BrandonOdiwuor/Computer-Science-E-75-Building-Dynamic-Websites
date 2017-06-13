<?php
require_once('model.php');
require_once('user.php');
/**
 *
 */
class Stock extends Model
{
  public function __construct()
  {
      $this->connect();
  }

  public function quote($symbol)
  {
    $stock = array();
    $url= "http://download.finance.yahoo.com/d/quotes.csv?s={$symbol}&f=sl1n&e=.csv";
    $handle = fopen($url, "r");
    if($data = fgetcsv($handle))
    {
      if(isset($data[1])){
        $stock = array('symbol' => $data[0],
                       'price' => $data[1],
                       'company_name' => $data[2]);
      }
    }

    return $stock;
  }

  public function buy($name, $symbol, $shares, $price, $user_id)
  {
    $user = new User;
    $cost = $shares * $price;
    $balance = $user->balance($user_id) - $cost;
    $transaction = 'BUY';

    $balance_update_sql = 'UPDATE users SET balance=:balance WHERE id=:user_id';

    if($id = $this->stock_exists($symbol))
    {
      $original_shares = $this->shares($id);
      $shares += $original_shares;
      $new_stock_sql = 'UPDATE stocks SET shares=:shares WHERE id=:id';
    }
    else
    {
      $new_stock_sql = 'INSERT INTO stocks';
      $new_stock_sql .= '(name, symbol, shares, purchase_price, user_id) ';
      $new_stock_sql .= 'VALUES(:name, :symbol, :shares, :purchase_price, :user_id)';
    }


    $new_transaction_sql = 'INSERT INTO transactions';
    $new_transaction_sql .= '(user_id, transaction, time, symbol,	shares, price) ';
    $new_transaction_sql .= 'VALUES (:user_id, :transaction, NOW(), :symbol,	:shares, :price)';
    try
    {
      $this->conn->beginTransaction();
      $balance_update_stmt = $this->conn->prepare($balance_update_sql);
      $new_stock_stmt = $this->conn->prepare($new_stock_sql);
      $new_transaction_stmt = $this->conn->prepare($new_transaction_sql);

      if($balance_update_stmt && $new_stock_sql && $new_transaction_stmt)
      {

        $balance_update_stmt ->bindParam(':balance', $balance);
        $balance_update_stmt ->bindParam(':user_id', $user_id);
        $balance_update_stmt->execute();

        $new_stock_stmt->bindParam(':shares', $shares);
        if($id)
        {
          $new_stock_stmt->bindParam(':id', $id);
        }
        else
        {
          $new_stock_stmt->bindParam(':name', $name);
          $new_stock_stmt->bindParam(':symbol', $symbol);
          $new_stock_stmt->bindParam(':purchase_price', $price);
          $new_stock_stmt->bindParam(':user_id', $user_id);
        }
        $new_stock_stmt -> execute();

        $new_transaction_stmt->bindParam(':user_id', $user_id);
        $new_transaction_stmt->bindParam(':transaction', $transaction);
        $new_transaction_stmt->bindParam(':symbol', $symbol);
        $new_transaction_stmt->bindParam(':shares', $shares);
        $new_transaction_stmt->bindParam(':price', $cost);
        $new_transaction_stmt->execute();

        $this->conn->commit();
      }
    }
    catch (PDOException $e)
    {
      $this->conn->rollBack();
      echo 'Statement preparation error. ' . $e->getMessage();
      exit();
    }

  }

  public function sell($stock_id, $price)
  {
    $stock = $this->stock($stock_id);
    $symbol = $stock['symbol'];
    $shares = $stock['shares'];
    $transaction = "SELL";
    $user_id = $stock['user_id'];

    $user = new User;
    $selling_price = $price * $shares;
    $balance = $user->balance($stock['user_id']) + $selling_price ;

    $remove_stock_sql = 'DELETE FROM stocks WHERE id=:stock_id';
    $balance_update_sql = 'UPDATE users SET balance=:balance WHERE id=:user_id';
    $new_transaction_sql = 'INSERT INTO transactions';
    $new_transaction_sql .= '(user_id, transaction, time, symbol,	shares, price) ';
    $new_transaction_sql .= 'VALUES (:user_id, :transaction, NOW(), :symbol,	:shares, :price)';
    try
    {
      $this->conn->beginTransaction();
      $remove_stock_stmt = $this->conn->prepare($remove_stock_sql);
      $balance_update_stmt = $this->conn->prepare($balance_update_sql);
      $new_transaction_stmt = $this->conn->prepare($new_transaction_sql);

      if($remove_stock_stmt && $balance_update_stmt && $new_transaction_stmt)
      {
        $remove_stock_stmt->bindParam(':stock_id', $stock_id);
        $remove_stock_stmt->execute();

        $balance_update_stmt->bindParam(':balance', $balance);
        $balance_update_stmt->bindParam(':user_id', $user_id);
        $balance_update_stmt->execute();

        $new_transaction_stmt->bindParam(':user_id', $user_id);
        $new_transaction_stmt->bindParam(':transaction', $transaction);
        $new_transaction_stmt->bindParam(':symbol', $symbol);
        $new_transaction_stmt->bindParam(':shares', $shares);
        $new_transaction_stmt->bindParam(':price', $selling_price);
        $new_transaction_stmt->execute();

        $this->conn->commit();
      }
    }
    catch (Exception $e)
    {
      $this->conn->rollBack();
      echo 'Statement preparation error. ' . $e->getMessage();
      exit();
    }


  }

  public function stock($id)
  {
    $stock = array();
    $sql = 'SELECT name, symbol, shares, purchase_price, user_id ';
    $sql .= 'FROM stocks WHERE id=:id';
    try
    {
      $stmt = $this->conn->prepare($sql);
      if($stmt)
      {
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if($stock_returned = $stmt->fetch())
        {
          $stock = array('name' => $stock_returned['name'],
                       'symbol' => $stock_returned['symbol'],
                       'shares' => $stock_returned['shares'],
                       'purchase_price' => $stock_returned['purchase_price'],
                       'user_id' => $stock_returned['user_id']);
        }
      }
    }
    catch (PDOException $e)
    {
      echo 'Statement preparation error. ' . $e->getMessage();
      exit();
    }
    return $stock;
  }

  public function portfolio($user_id)
  {
    $portfolio = array();
    $sql = 'SELECT name, symbol, shares, purchase_price, id FROM stocks ';
    $sql .= 'WHERE user_id=:user_id';
    try
    {
      $stmt = $this->conn->prepare($sql);
      if($stmt)
      {
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        while($row = $stmt->fetch())
        {
          $portfolio[] = array($row['name'], $row['symbol'], $row['shares'], $row['purchase_price'], $row['id']);
        }
      }
    }
    catch (PDOException $e)
    {
      echo 'Statement preparation error. ' . $e->getMessage();
      exit();
    }
    return $portfolio;
  }

  public function symbol($name)
  {
    # Yahoo stock look up API
  }

  public function stock_exists($symbol)
  {
    $sql = 'SELECT id FROM stocks WHERE symbol=:symbol';
    try
    {
      $stmt = $this->conn->prepare($sql);
      if($stmt)
      {
        $stmt->bindParam(':symbol', $symbol);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result['id'])
        {
          return $result['id'];
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

  public function shares($id)
  {
    $sql = 'SELECT shares FROM stocks WHERE id=:id';
    try
    {
      $stmt = $this->conn->prepare($sql);
      if($stmt)
      {
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result['shares'])
        {
          return $result['shares'];
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
}
//$stock = new Stock;
//print_r($stock->quote('goog'));
//print_r($stock->portfolio(1));
//$stock -> buy('Facebook', 'goog', 5, 350, 1);
//print_r($stock->stock(1));
//$stock->sell(2, 950);
//$stock-> stock_exists('goog');
//print_r($stock->shares(9));
?>
