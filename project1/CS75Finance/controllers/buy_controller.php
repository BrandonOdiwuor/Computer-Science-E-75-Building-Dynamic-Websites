<?php
function buy_stock()
{
  $symbol = htmlspecialchars($_POST['symbol']);
  $shares = htmlspecialchars($_POST['shares']);

  if(empty($symbol) || empty($shares))
  {
    $error_messages = array();
    if (empty($symbol))
    {
      $error_messages[] = "Please enter the company's symbol";

    }
    if(empty($shares)){
      $error_messages[] = "Please enter the number of shares";
    }

    render_buy_form(array('shares' => $shares,
                          'symbol' => $symbol,
                          'error_messages' => $error_messages));
  }
  else
  {
    require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/models/stock.php');
    $stock = new Stock;
    $quote = $stock->quote($symbol);
    $name = $quote['company_name'];
    $price = $quote['price'];
    if($price == 'N/A' && $name == 'N/A')
    {
      $error_messages[] = "Please enter a valid company symbol";
      render_buy_form(array('shares' => $shares,
                            'symbol' => $symbol,
                            'error_messages' => $error_messages));
    }
    else
    {
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/models/stock.php');
      $user_id = $_SESSION['user_id'];
      $user = new User;
      $balance = $user->balance($user_id);
      $shares_total_price = $price * $shares;
      if($balance < $shares_total_price)
      {
        $error_messages[] = "Insuficient balance";
        render_buy_form(array('shares' => $shares,
                              'symbol' => $symbol,
                              'error_messages' => $error_messages));
      }
      else
      {
        $stock->buy($name, $symbol, $shares, $price, $user_id);
        header('Location: home');
      }
    }
  }
}
function render_buy_form($form_elements = array())
{
  render('header');
  render('buy', $form_elements);
  render('footer');
}
?>
