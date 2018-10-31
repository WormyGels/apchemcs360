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

    <?php require_once "nav.php" ; ?>
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

    <script src="../js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
