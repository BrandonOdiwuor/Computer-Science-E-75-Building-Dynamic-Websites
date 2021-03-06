<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Three Aces</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<?php if(isset($level)): ?>
  <!-- Bootstrap JS -->
  <script type="text/javascript" src="../../html/assets/js/bootstrap.js"></script>
  <script type="text/javascript" src="../../html/assets/js/bootstrap.min.js"></script>
  <!-- Bootstrap Core CSS -->
  <link href="../../html/assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="../../html/assets/css/custom.css" rel="stylesheet">
<?php else: ?>
  <!-- Bootstrap JS -->
  <script type="text/javascript" src="../html/assets/js/bootstrap.js"></script>
  <script type="text/javascript" src="../html/assets/js/bootstrap.min.js"></script>

  <!-- Bootstrap Core CSS -->
  <link href="../html/assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="../html/assets/css/custom.css" rel="stylesheet">
<?php endif ?>

</head>
<body>
  <nav class="navbar navbar-default topnav" role="navigation" id="homepage-nav">
      <div class="container topnav">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand topnav" href="index.php">Three Aces</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <?php
                if (isset($level)) {
                  echo '<li><a href="../home">Home</a></li>';
                }
                else {
                  echo '<li><a href="home">Home</a></li>';
                }
                if(array_key_exists('order_cart', $_SESSION))
                {
                  if (isset($level)) {
                    echo '<li><a href="../checkout">Checkout Cart</a></li>';
                  }
                  else {
                    echo '<li><a href="checkout">Checkout Cart</a></li>';
                  }
                }
              ?>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
  </nav>
  <!-- /Homepage Navigation Bar-->
  <div class="container">
    <div class="" style="text-align:center;">
      <h3>
        <strong>Three Aces</strong>
      </h3>
      <p>
        1613 Massachusetts Ave<br>
        Cambridge, MA 02139<br>
        Btwn Mellen & Everett St<br>

    </p>
    </div>
  </div>
