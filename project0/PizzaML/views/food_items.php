<div class="container">
  <?php
    foreach($food_items as $food_item)
    {
      echo '<div class="panel panel-default">';
      echo '<div class="panel-heading">';
      echo '<h3 class="panel-title">'. $food_item->name .'</h3>';
      echo '</div>';
      echo '<div class="panel-body">';
      echo '<strong>Cartegory: </strong>'. $food_item->cartegory;
      echo "<br>";
      echo '<strong>Size: </strong>'. $food_item->size;
      echo "<br>";
      $price = intval($food_item->price);
      $price = number_format($price/100, 2);
      echo '<strong>Price: </strong>$ '. $price;
      echo '</div>';
      echo '<div class="panel-footer">';
      echo '<a class="btn btn-primary btn-block" href="order/'.$food_item['id'].'">Order</a>';
      echo '</div>';
      echo '</div>';
      echo "<br>";
    }
  ?>
</div>
