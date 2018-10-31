<?php
/*
* index page for the instructor when they are logged in
* they will be able to see student progress here
*/

session_start() ;
require_once "../php/UserBundle.php" ;
$message = "" ;

//generates random string for join key
function generateKey($length = 32) {
  return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length) ;
}
//if we aren't logged in
if (!isset($_SESSION["user"])) {
  header("Location: ../index.php") ;
}
$user = unserialize($_SESSION["user"]) ;
//we are logged in but not as a teacher
if ($user->type() != 2) {
  header("Location: ../index.php") ;
}
//now we can check for form
if (isset($_POST["classname"])) {
  $name = $_POST["classname"] ;
  require_once "../php/classes/Query.php" ;
  $key = generateKey() ;
  $query = new Query("INSERT INTO classes (instructor_id, class_name, join_key) VALUES (?, ?, ?)", array($user->getId(), $name, $key)) ;
  if ($query->execute()) {
    $message = "Class \"$name\" created. Give key \"$key\" to your students." ;
  }
  else {
    $message = "There was a problem creating the class." ;
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>AP Chemistry - Create a Class</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <?php require_once "nav.php" ; ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">New Class</h1>
      </div>
      <div class="container">
        <form method="post">
          <div class="form-group">
            <label>Class Name</label>
            <input name="classname" type="input" class="form-control" id="classnameInput" placeholder="Class Name">
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
          <div class="form-group">
            <label><?php echo $message ; ?></label>
          </div>
        </form>
      </div>
    </main>

    <script src="../js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
