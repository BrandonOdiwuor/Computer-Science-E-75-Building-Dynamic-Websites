<div class="container">
  <br>
    <p class="text-center">
      <a href="home"><strong>Continue Shopping</strong></a>
    </p>

  <br>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><strong>Food Cart</strong></h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4"><u><strong>NAME</strong></u></div>
            <div class="col-md-4"><u><strong>QTY</strong></u></div>
            <div class="col-md-4"><u><strong>PRICE</strong></u></div>
            <br>
            <?php
              foreach ($cart as $name => $detail)
              {
                echo '<div class="col-md-4"><strong>'.$name.'</strong></div>';
                echo '<div class="col-md-4"><strong>'.$detail['quantity'].'</strong></div>';
                $price = number_format($detail['price']/100, 2);
                echo '<div class="col-md-4"><strong>$ '.$price.'</strong></div>';
              }
            ?>
          </div>
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-md-4"><strong></strong></div>
            <div class="col-md-4"><strong></strong></div>
            <div class="col-md-4">
              <strong>$ <?php echo number_format($total/100, 2); ?></strong>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4"><strong></strong></div>
        <div class="col-md-4"><strong></strong></div>
        <div class="col-md-4">
          <a href="index.php?page=pay" class="btn btn-primary btn-block">
            <strong>PAY</strong>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>
