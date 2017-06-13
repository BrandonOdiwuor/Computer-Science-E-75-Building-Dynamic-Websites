<?php
function render_transactions_table()
{
  render('header');
  $transactions = transactions();
  render('history', array('transactions' => $transactions));
  render('footer');
}

function transactions()
{
  require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/models/transaction.php');
  $transaction = new Transaction;
  $user_id = $_SESSION['user_id'];
  return $transaction->transactions($user_id);
}
?>
