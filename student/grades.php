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

$result = [] ;
//get an array of quizzes for the student
$query = new Query("SELECT grades.quiz_id, correct, total, comments, quiz_name FROM grades, quizzes WHERE student_id=? AND quizzes.quiz_id=grades.quiz_id GROUP BY quiz_id", $user->getId()) ;
if ($query->execute() && $query->hasResult()) {
  $result = $query->getResult() ;
}

$grades = [] ;
if (count($result) <= 1) {
  $grades[0] = $result ;
}
else {
  $grades = $result ;
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

    <title>AP Chemistry - Your Grades</title>

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
        <h1 class="h2">Grades</h1>
        <div class="btn-toolbar mb-2 mb-md-0"></div>
      </div>
      <div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Quiz Name</th>
              <th scope="col">Score</th>
              <th scope="col">Percentage</th>
              <th scope="col">Instructor Feedback</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($grades as $grade) { ?>
            <tr>
              <td><a href="grades.php?quiz=<?php echo $grade->quiz_id ; ?>"><?php echo $grade->quiz_name ; ?></a></th>
              <td><?php echo $grade->correct."/".$grade->total ; ?></td>
              <td><?php echo (round($grade->correct/$grade->total*100, 2))."%" ; ?></td>
              <td><?php echo $grade->comments ; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </main>

    <?php include "modals/generic.php" ; ?>

    <script src="../js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="../js/student/student-grades.js" crossorigin="anonymous"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
