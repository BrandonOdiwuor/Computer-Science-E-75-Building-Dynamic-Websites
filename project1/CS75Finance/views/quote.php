<?php if(isset($not_form)): ?>
  <div class="container">
    <div class="row" style="padding-top:20px;">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="panel panel-primary">
          <?php
            echo '<div class="panel-heading">'.$title.'</div>'
          ?>
          <div class="panel-body">
            <ul>
              <?php
                echo '<p> A share of '. $title . ' ('.$symbol.') costs <strong>$'.$amount.'</strong></p>';
              ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
<?php else: ?>
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
        <input type="hidden" class="form-control" name="page" value="quote">
        <div class="form-group">
          <label for="symbol">Stock Symbol:</label>
          <input type="text" class="form-control" name="symbol" id="symbol" placeholder="Enter symbol">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-default btn-block" value="Get Quote" name="get_quote">
        </div>
      </form>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
<?php endif ?>
