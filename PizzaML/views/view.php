<?php include('templates/header.php'); ?>
<?php
  include('../models/model.php');
  $model = new Model();
  echo $model->getprice(array('cartegory' => 'pizza', 'name' => 'Mushrooms',
  'size' => 'large'));
  echo "<br>";
  echo $model->getprice(array('cartegory' => 'special-dinner',
  'name' => 'Chicken Wing Dinner', 'price' => 'price'));
  echo "<br>";
  $price = $model->getprice(array('cartegory' =>'spaghetti-or-ziti',
  'with' => 'Sauce', 'price' => 'price'));
  $price = $price * 2;
  echo $price;
?>
<?php include('templates/footer.php'); ?>
