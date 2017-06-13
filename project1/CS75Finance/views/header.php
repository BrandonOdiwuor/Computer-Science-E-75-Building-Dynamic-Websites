<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>C$75 Finance</title>

    <!-- JS Imports -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>

    <!-- CSS Imports -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="container">
      <div class="top">
        <div class="logo" >
          <a href="home">
            <img id="logo" src="../assets/img/logo.png" alt="C$75 Finance">
          </a>
        </div>
        <?php if(isset($_SESSION['user_id'])): ?>
        <ul class="nav nav-pills" style="">
          <li>
            <a href="quote">Quote</a>
          </li>
          <li>
            <a href="buy">Buy</a>
          </li>
          <li>
            <a href="sell">Sell</a>
          </li>
          <li>
            <a href="transactions">History</a>
          </li>
          <li>
            <a href="logout"><strong>Log Out</strong></a>
          </li>
        </ul>
        <?php endif ?>
      </div>
    </div>
