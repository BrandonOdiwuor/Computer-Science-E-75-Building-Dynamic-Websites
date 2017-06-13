<br><br><br>
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title"><strong>Select Cartegory</strong></h2>
    </div>
    <div class="panel-body">
      <form class="" action="../html/home" method="post">
        <div class="input-group">
          <input type="hidden" class="form-control" name="page" value="cartegory">
          <select class="form-control" name="cartegory">
            <option>Pick cartegory to order from...</option>
            <?php
                foreach($cartegories as $cartegory)
                {
                  $cartegory = (string)$cartegory;
                  echo "<option value=$cartegory>$cartegory</option>";
                }
            ?>
          </select>
          <span class="input-group-btn">
            <input type="submit" class="btn btn-default" name="submit" value="Go">
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
