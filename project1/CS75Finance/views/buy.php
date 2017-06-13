
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
        <input type="hidden" class="form-control" name="page" value="buy">
        <div class="form-group">
          <label for="symbol">Stock Symbol:</label>
          <?php if(isset($symbol)):
            echo '<input type="text" class="form-control" name="symbol" id="symbol" placeholder="Enter symbol" value="'.$symbol.'">'
          ?>
          <?php else: ?>
            <input type="text" class="form-control" name="symbol" id="symbol" placeholder="Enter symbol">
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="shares">Shares:</label>
          <?php if(isset($shares)):
            echo '<input type="text" class="form-control" name="shares" id="shares" placeholder="Number of shares" value="'.$shares.'">'
          ?>
          <?php else: ?>
            <input type="text" class="form-control" name="shares" id="shares" placeholder="Number of shares">
          <?php endif ?>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-default btn-block" value="Buy" name="buy">
        </div>
      </form>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
