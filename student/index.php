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
if (!inClass($user)) {
  header("Location: joinclass.php") ;
}
//find the necessary information to display on this page
//prove that they have grades
$hasGrades = false ;
//need points, max points, number of quizzes taken, and number of quizzes available
$maxPoints = 0 ;
$earnedPoints = 0 ;
$numQuizzesTaken = 0 ;
$numQuizzes = 0 ;
$return = [] ;
$query = new Query("SELECT correct, total, points FROM quizzes, grades WHERE student_id=? AND quizzes.quiz_id=grades.quiz_id", $user->getId()) ;
$query2 = new Query("SELECT COUNT(quiz_id) AS amount FROM quizzes WHERE class_id=? GROUP BY class_id", getClass($user)) ;
if ($query->execute() && $query->hasResult() && $query2->execute() && $query2->hasResult()) {
  $return = $query->getResult() ;
  $return2 = $query2->getResult() ;
  $numQuizzes = $return2->amount ;
  if (count($return) == 1) {
    $result[0] = $return ;
  }
  else {
    $result = $return ;
  }

  foreach ($result as $quiz) {
    $maxPoints += $quiz->points ;
    $earnedPoints += round($quiz->correct/$quiz->total, 2)*$quiz->points ;
    $numQuizzesTaken++ ;
  }
  $pointsPercent = round($earnedPoints/$maxPoints*100, 2) ;
  $quizNumPercent = round($numQuizzesTaken/$numQuizzes*100, 2) ;

  $hasGrades = true ;
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

    <title>AP Chemistry - Student Dashboard</title>

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
        <h1 class="h2">Progress</h1>
        <div class="btn-toolbar mb-2 mb-md-0"></div>
      </div>
      <div id="overall-score">
        <div class="row">
          <div class="chart-container col-sm-12">
            <?php if ($hasGrades) { ?>
            <div class="bar-container col-sm-2">
              <h6>Possible Points</h6>
              <span class="block-label"><?php echo $earnedPoints ; ?> / <?php echo $maxPoints ; ?> points earned</span>
              <span class="block-label"><?php echo $pointsPercent ; ?>%</span>
              <div class="bar">
                <div style="width: <?php echo $pointsPercent ; ?>% ;" id="points" class="progress"></div>
              </div>
            </div>
            <div class="bar-container col-sm-2">
              <h6>Quizzes Taken</h6>
              <span class="block-label"><?php echo $numQuizzesTaken ; ?> / <?php echo $numQuizzes ; ?> quizzes taken</span>
              <span class="block-label"> </span>
              <div class="bar">
                <div style="width: <?php echo $quizNumPercent ; ?>% ;" id="quizzes" class="progress"></div>
              </div>
            </div>
            <?php }
            else { ?>
            <div class="col-sm-12">
              <h2>You have not taken any quizzes.</h2>
            </div>
          <?php } ?>

          </div>
        </div>

      </div>
    </main>

    <script src="../js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
