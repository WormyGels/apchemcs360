<?php
/*
* index page for the student when they are logged in
* here they will see their own progress and anything they have yet to do
*/

session_start() ;
require_once "../php/UserBundle.php" ;
//if we aren't logged in
if (!isset($_SESSION["user"])) {
  header("Location: ../index.php") ;
}
$user = unserialize($_SESSION["user"]) ;
//we are logged in but not as a student
if ($user->type() != 3) {
  header("Location: ../index.php") ;
}
if (inClass($user)) {
  header("Location: index.php") ;
}

?>

<!doctype html>
<html lang="en">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="AP Chemistry Tutoring Website">
    <meta name="author" content="JWells, AKirby, SGreen">
    <link rel="icon" href="">

    <title>AP Chemistry - Register for Class</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/cover.css" rel="stylesheet">
  </head>

  <body class="text-center">

    <div id="background-image"></div>

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
        </div>
      </header>

      <main role="main" class="inner cover">
        <h1 class="cover-heading">Class Registration</h1>
        <h1 class="h6">You are currently not registered for a class. Enter the class key provided by your instructor.</h1>
        <form autocomplete="off" class="form-signin" method="post" action="../php/registerstudent.php">
          <div class="form-group">
            <label for="input" class="sr-only">Class Key</label>
            <input name="class_key" type="input" id="class-key" class="form-control" placeholder="Class Key" required autofocus>
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

    <script src="../js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
