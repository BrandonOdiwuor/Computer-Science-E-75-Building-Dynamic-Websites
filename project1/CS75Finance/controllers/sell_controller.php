<?php
function sell_stock()
{
  require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/models/stock.php');
  $stock = new Stock;
  $stock_id = htmlspecialchars($_POST['id']);
  $symbol = $stock->stock($stock_id)['symbol'];
  $current_price = $stock->quote($symbol)['price'];
  $stock->sell($stock_id, $current_price);
  header('Location: home');
}

function load_and_render_sell_form()
{
  require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/models/stock.php');
  $stock = new Stock;
  $user_id = $_SESSION['user_id'];
  $portfolio = $stock->portfolio($user_id);
  render_sell_form(array('stocks' => $portfolio));
}
function render_sell_form($form_elements = array())
{
  render('header');
  render('sell', $form_elements);
  render('footer');
}
?>
