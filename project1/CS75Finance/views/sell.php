<div class="container">
  <div class="row" style="padding-top:20px;">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <?php if(isset($error_messages)): ?>
        <div class="error-messages bg-warning">
          <ul>
            <?php foreach($error_messages as $error_message)
              echo '<li>' . $error_message . '</li>';
            ?>
          </ul>
        </div>
      <?php endif ?>
      <form class="" action="home" method="post">
        <input type="hidden" class="form-control" name="page" value="sell">
        <div class="form-group">
          <label for="symbol">Stock Symbol:</label>
          <select class="form-control" name="id" id="symbol">
            <option>Select Symbol...</option>
            <?php
              foreach($stocks as $stock)
              {
                echo '<option value="'.$stock[4].'">'.$stock[1].'</option>';
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-default btn-block" value="Sell" name="sell">
        </div>
      </form>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
