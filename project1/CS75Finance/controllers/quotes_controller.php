<?php
function get_quote()
{
  $symbol = htmlspecialchars($_POST['symbol']);
  $error_messages = array();
  if(empty($symbol))
  {
    $error_messages[] = "Please enter the company's symbol";
    render_quote_form(array('error_messages' => $error_messages));
  }
  else
  {
    require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/models/stock.php');
    $stock = new Stock;
    $quote = $stock->quote($symbol);
    if($quote['price'] == 'N/A' && $quote['company_name'] == 'N/A')
    {
      $error_messages[] = "Please enter a valid company symbol";
      render_quote_form(array('error_messages' => $error_messages));
    }
    else
    {
      render('header');
      render('quote', array('not_form' => true,
                            'title'=>$quote['company_name'],
                            'symbol' => $quote['symbol'],
                            'amount'=>$quote['price']));
      render('footer');
    }
  }
}

function render_quote_form($form_elements = array())
{
  render('header');
  render('quote', $form_elements);
  render('footer');
}
?>
