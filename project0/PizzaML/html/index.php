<?php
session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . '/PizzaML/includes/helpers.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/PizzaML/models/food.php');
$model = new Food;

// determine which page to render
if (isset($_GET['page']))
  $page = $_GET['page'];
else
  $page = 'index';

// show page
switch ($page)
{
  case 'index':
    render('templates/header');
    render('index', array('cartegories' => $model->cartegories()));
    render('templates/footer');
    break;

  case 'cartegory':
    if(isset($_GET['cartegory']))
    {
        render('templates/header');
        render(
          'food_items',
          array('food_items' => $model->index($_GET['cartegory'])));
        render('templates/footer');
    }
    break;

  case 'order':
    if(isset($_GET['id']))
    {
      render('templates/header');
      $order_number = htmlspecialchars($_GET['id']);
      $details = $model->order_detail($order_number);
      render(
        'order',
        array('order_number' => $order_number, 'food_item' => $details));
      render('templates/footer');
    }
    break;

  case 'cartHandler':
    $order_number = htmlspecialchars($_GET['id']);
    $order_quantity = htmlspecialchars($_GET['quantity']);
    $order_price = $model->price($order_number);
    add_food_to_cart($order_number, $order_price, $order_quantity);
    header('Location: index.php?page=checkout');
    break;

  case 'checkout':
    if(array_key_exists('order_cart', $_SESSION))
    {
      render('templates/header');
      $cart_items = $_SESSION['order_cart'];
      $cart = array();
      $total = 0;
      foreach($cart_items as $cart_item => $details)
      {
          $total += intval($details['price']);
          $item_name = $model->name($cart_item);
          $cart[(string) $item_name] = $details;
      }
      render('checkout', array('cart' => $cart, 'total' => $total));
      render('templates/footer');
    }
    break;

  case 'pay':
    session_unset();
    header('Location: index.php');
    break;
}

function add_food_to_cart($id, $price, $quantity)
{
  global $model;
  if(!array_key_exists('order_cart', $_SESSION))
  {
    $_SESSION['order_cart'] = array();
  }
  $order_cart = $_SESSION['order_cart'];
  if(array_key_exists($id, $order_cart))
  {
    $item = $order_cart[$id];
    $item['quantity'] += $quantity;
    $order_cart[$id] = $item;
  }
  else {
    $order_cart[$id] = array('quantity' => $quantity);
  }
  $cost = $model->price($id);
  $order_cart[$id]['price'] =   $order_cart[$id]['quantity'] * $cost;
  $_SESSION['order_cart'] = $order_cart;
}
?>
