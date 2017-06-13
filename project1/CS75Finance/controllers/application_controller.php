<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/includes/helpers.php');

if (isset($_SESSION['user_id']))
{
  if (isset($_GET['page']))
    $page = $_GET['page'];
  elseif (isset($_POST['page']))
    $page = 'post_' . $_POST['page'];
  else
    $page = 'index';

  switch($page)
  {
    case 'index':
      render('header');
      $portfolio = porpulate_table();
      render('index', $portfolio);
      render('footer');
      break;
    case 'quote':
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/controllers/quotes_controller.php');
      render_quote_form();
      break;
    case 'post_quote':
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/controllers/quotes_controller.php');
      get_quote();
      break;
    case 'buy':
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/controllers/buy_controller.php');
      render_buy_form();
      break;
    case 'post_buy':
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/controllers/buy_controller.php');
      buy_stock();
      break;
    case 'sell':
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/controllers/sell_controller.php');
      load_and_render_sell_form();
      break;
    case 'post_sell':
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/controllers/sell_controller.php');
      sell_stock();
      break;
    case 'transactions':
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/controllers/transactions_controller.php');
      render_transactions_table();
      break;
    case 'sign_out':
      session_destroy();
      header('Location: home');
      break;
    case 'sign_in':
      header('Location: home');
      break;
    case 'sign_up':
      header('Location: home');
      break;
  }
}
elseif (isset($_POST['page']))
{
  $page = $_POST['page'];
  switch($page)
  {
    case 'sign_in':
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/controllers/sign_in_controller.php');
      authenticate_user();
      break;

    case 'sign_up':
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/controllers/sign_up_controller.php');
      register_user();
      break;
  }
}
else
{
  if (isset($_GET['page']))
    $page = $_GET['page'];
  else
    $page = 'sign_in';

  switch($page)
  {
    case 'sign_in':
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/controllers/sign_in_controller.php');
      render_sign_in_form();
      break;
    case 'sign_up':
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/controllers/sign_up_controller.php');
      render_sign_up_form();
      break;
    case 'quote':
      header('Location: home');
      break;
    case 'buy':
      header('Location: home');
      break;
    case 'sell':
      header('Location: home');
      break;
    case 'transactions':
      header('Location: home');
      break;
  }
}

function porpulate_table()
{
  require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/models/stock.php');
  require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/models/user.php');
  $user = new User;
  $stock = new Stock;
  $stocks = array();
  $user_id = $_SESSION['user_id'];
  $portfolios = $stock->portfolio($user_id);
  $total_stock_value = 0;
  $balance = $user->balance($user_id);
  $total = 0;
  $total_profit = 0;
  foreach($portfolios as $portfolio)
  {
    $_portfolio = array();
    $_portfolio['symbol'] = $portfolio[1];
    $_portfolio['name'] = $portfolio[0];
    $shares = $portfolio[2];
    $_portfolio['quantity'] = $shares;
    $purchase_price = $portfolio[3];
    $_portfolio['purchase_price'] = $purchase_price;
    $price = price($portfolio[1]);
    $_portfolio['current_price'] = $price;
    $total_purchase_price = $shares * $purchase_price;
    $_portfolio['total_purchase_price'] = $total_purchase_price;
    $total_current_price = $shares * $price;
    $_portfolio['total_current_price'] = $total_current_price;
    $total_stock_value += $total_current_price;
    $profit = ($total_purchase_price - $total_current_price);
    $_portfolio['profit'] = $profit;
    $total_profit += $profit;
    $stocks[] = $_portfolio;
  }
  $total = $balance + $total_stock_value;
  return array('stocks' => $stocks,
               'total_stock_value' => $total_stock_value,
               'total' => $total,
               'balance' => $balance,
               'total_profit' => $total_profit);
}

function price($symbol)
{
  require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/models/stock.php');
  $stock = new Stock();
  $quote = $stock->quote($symbol);
  return $quote['price'];
}

function total()
{

}
?>
