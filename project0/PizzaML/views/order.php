<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo $food_item->name; ?></h3>
    </div>
    <div class="panel-body">
      <strong>Cartegory: </strong> <?php echo $food_item->cartegory; ?><br>
      <strong>Size: </strong> <?php echo $food_item->size; ?><br>
      <?php
        $price = intval($food_item->price);
        $price = number_format($price/100, 2);
        echo '<strong>Price: </strong>$ '. $price;
      ?>
    </div>
    <div class="panel-footer">
      <form class="" action="index.php" method="get">
        <input type="hidden" class="form-control" name="page" value="cartHandler">
        <input type="hidden" class="form-control" name="id" value="<?php echo $order_number?>">
        <div class="form-group">
          <label for="quantity">Quantity</label>
          <input type="text" name="quantity" class="form-control" id="quantity">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary btn-block"
                 name="submit" value="Add to Cart">
        </div>
      </form>
    </div>
    </div>
</div>
