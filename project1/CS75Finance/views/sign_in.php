<div class="container">
  <div class="row" id="sign-in" style="padding-top:20px;">
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
      <form action="home" method="post">
        <input type="hidden" class="form-control" name="page" value="sign_in">
        <div class="form-group">
          <label for="email">Email address:</label>
          <?php if(isset($email)) : ?>
            <?php echo '<input type="email" class="form-control" name="email" id="email" value="'.$email.'">' ?>
          <?php else: ?>
            <input type="email" class="form-control" name="email" id="email">
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <?php if(isset($password)) : ?>
            <?php echo '<input type="password" class="form-control" name="password" id="pwd" value="'.$password.'">' ?>
          <?php else: ?>
            <input type="password" class="form-control" name="password" id="pwd">
          <?php endif ?>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-default btn-block" value="Sign In" name="sign_in">
        </div>
      </form>
      <div class="text-center">
        <p>or <a href="register">register</a> for an account
        </p>
      </div>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
