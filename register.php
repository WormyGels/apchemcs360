<?php
//if we are already logged in then we redirect
session_start() ;
if (isset($_SESSION["user"])) {
  header("Location: php/splash.php") ;
}

$failure = false ;
if (isset($_GET["fail"])) {
  $failure = true ;
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

    <title>AP Chemistry - Register</title>

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
            <a class="nav-link" href="index.php">Home</a>
            <a class="nav-link" href="login.php">Login</a>
            <a class="nav-link active" href="register.php">Register</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover">
        <h1 class="cover-heading">Student, Instructor, and Administrator Registration</h1>
        <form class="form-signin" method="post" action="php/register.php">
          <div class="form-group">
            <label for="input" class="sr-only">Username</label>
            <input name="username" type="input" id="username" class="form-control" placeholder="Username" required autofocus>
          </div>
          <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>
          </div>
          <div id="radio-group" class="form-group">
            <h1 class="cover-heading">
              I am a:
            </h1>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label id="student" class="btn btn-secondary active">
                <input value=3 type="radio" name="type" autocomplete="off" checked> Student
              </label>
              <label id="instructor" class="btn btn-secondary">
                <input  value=2 type="radio" name="type" autocomplete="off"> Instructor
              </label>
              <label id="administrator" class="btn btn-secondary">
                <input value=1 type="radio" name="type" autocomplete="off"> Administrator
              </label>
            </div>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Created By: Jeremy Wells, Austin Kirby, and Stephen Green for WKU</p>
        </div>
      </footer>
    </div>

    <div id="failModal" class="modal fade"tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="modal-title" style="text-shadow: none ; color: black ;" class="modal-title">Bad Key</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div id="modal-body" style="text-align: left ; text-shadow: none ; color: black ;" class="modal-body">
            You have entered an incorrect special key.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script src="js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/register/register.js" crossorigin="anonymous"></script>

    <?php if ($failure) {?>
    <script>
      $(function() {
        $("#failModal").modal() ;
      }) ;
    </script>
    <?php } ?>

  </body>
</html>
