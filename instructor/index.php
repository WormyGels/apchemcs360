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

require_once("../php/classes/Query.php") ;
$query = new Query("SELECT COUNT(in_class.class_id) AS classes, COUNT(in_class.student_id) AS students
FROM classes, in_class
WHERE classes.class_id=in_class.class_id AND instructor_id=?
GROUP BY instructor_id", $user->getId()) ;

$classes = 0 ;
$students = 0 ;
$hasClasses = false ;
if ($query->execute() && $query->hasResult()) {
  $hasClasses = true ;
  $result = $query->getResult() ;
  $students = $result->students ;
  $classes = $result->classes ;

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

    <title>AP Chemistry - Instructor Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <link href="../css/main.css" rel="stylesheet">

  </head>

  <body>
    <?php require_once "nav.php" ; ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Overview</h1>
        <div class="btn-toolbar mb-2 mb-md-0"></div>
      </div>
      <div>
        <h4>Welcome <?php echo $user->getUsername() ; ?>!</h4>
        <?php if ($hasClasses) {?>
        <label class="block-label">You have <?php echo $classes ; ?> classes.</label>
        <label class="block-label">You have <?php echo $students ; ?> students.</label>

      <?php } else {?>
          <h6>You have no classes.</h6>
      <?php } ?>
      </div>
    </main>


    <script src="../js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
