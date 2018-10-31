<?php
/*
* index page for the instructor when they are logged in
* they will be able to see student progress here
*/

session_start() ;
require_once "../php/UserBundle.php" ;
//if we aren't logged in
if (!isset($_SESSION["user"])) {
  header("Location: ../index.php") ;
}
$user = unserialize($_SESSION["user"]) ;
//we are logged in but not as a teacher
if ($user->type() != 2) {
  header("Location: ../index.php") ;
}
//if we are on a valid class
$className = "Error" ;
$joinKey = "Error" ;
if (isset($_GET["class"])) {
  require_once "../php/classes/Query.php" ;
  //ensure that we are accessing one that belongs to us and not another instructor
  $query = new Query("SELECT class_name, join_key FROM classes WHERE class_id=? AND instructor_id=?", array($_GET["class"], $user->getId())) ;
  if ($query->execute() && $query->hasResult()) {
    $className = $query->getResult()->class_name ;
    $joinKey = $query->getResult()->join_key ;
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

    <title>AP Chemistry - <?php echo $className ; ?></title>

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
                  Gradebook
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="quizzes.php">
                  <span data-feather="shopping-cart"></span>
                  Create a Quiz
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>MANAGE ASSIGNMENTS</span>
              <a class="d-flex align-items-center text-muted" href="">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
            <?php require_once "getclasses.php" ; ?>
            <li class="nav-item">
              <a class="nav-link" href="newclass.php">
                <span data-feather="file-text"></span>
                Create a New Class
              </a>
            </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?php echo $className ; ?></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button> -->
            </div>
          </div>
          <div class="container">
            <h1 class="h3">Class Key</h1>
            <h1 class="h5"><?php echo $joinKey ; ?></h1>
            <span>Give students this key so they can join the course.</span>
          </div>
        </main>
      </div>
    </div>

    <script src="js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
