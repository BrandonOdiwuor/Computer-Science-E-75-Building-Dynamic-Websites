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
      <form class="" action="index.php" method="post">
        <input type="hidden" class="form-control" name="page" value="sign_up">
        <div class="form-group">
          <label for="first_name">First Name:</label>
          <?php if(isset($first_name)) : ?>
            <?php echo '<input type="text" class="form-control" name="first_name" id="first_name" value="'.$first_name.'">' ?>
          <?php else: ?>
            <input type="text" class="form-control" name="first_name" id="first_name">
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="surname">Surname:</label>
          <?php if(isset($surname)) : ?>
            <?php echo '<input type="text" class="form-control" name="surname" id="surname" value="'.$surname.'">' ?>
          <?php else: ?>
            <input type="text" class="form-control" name="surname" id="surname">
          <?php endif ?>
        </div>
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
          <input type="submit" class="btn btn-default btn-block" value="Sign Up" name="sign_up">
        </div>
      </form>
      <p class="text-center">Already have an account <a href="login">Sign In</a></p>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
