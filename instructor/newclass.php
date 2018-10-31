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
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">AP Chemistry</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../logout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="index.php">
                  <span data-feather="home"></span>
                  Home <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="grades.php">
                  <span data-feather="file"></span>
                  Grades
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="quizzes.php">
                  <span data-feather="shopping-cart"></span>
                  Quizzes
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="assignments.php">
                  <span data-feather="users"></span>
                  Assignments
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>YOUR CLASSES</span>
              <a class="d-flex align-items-center text-muted" href="">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
            <?php require_once "getclasses.php" ; ?>
            <li class="nav-item">
              <a class="nav-link active" href="newclass.php">
                <span data-feather="file-text"></span>
                Create a New Class
              </a>
            </li>
            </ul>
          </div>
        </nav>

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
      </div>
    </div>

    <script src="js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
