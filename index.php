<?php
//if we are already logged in then we redirect
session_start() ;
if (isset($_SESSION["user"])) {
  header("Location: php/splash.php") ;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="AP Chemistry Tutoring Website">
    <meta name="author" content="JWells, AKirby, SGreen">
    <link rel="icon" href="">

    <title>AP Chemistry Online Tutoring</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/cover.css" rel="stylesheet">
  </head>

  <body class="text-center">

    <div id="background-image"></div>

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">AP Chemistry</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="index.php">Home</a>
            <a class="nav-link" href="login.php">Login</a>
            <a class="nav-link" href="register.php">Register</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover">
        <h1 class="cover-heading">Web-Based Education: AP Chemistry</h1>
        <p class="lead">
          Use the power of the internet to ace your AP Chemistry exam.
          Built from the ground up with the course description for AP Chemistry, specifically designed to help you ace the exam.
        </p>
        <p class="lead">
          <a href="login.php" class="btn btn-lg btn-secondary">Login</a>
          <a href="register.php" class="btn btn-lg btn-secondary">Register</a>
        </p>
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Created By: Jeremy Wells, Austin Kirby, and Stephen Green for WKU</p>
        </div>
      </footer>
    </div>

    <script src="js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
