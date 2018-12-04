<?php
/*
* gradebook page student based
* only displays all students independent of class
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
//list all the students and have links to the page that show that students grade breakdown

require_once ("../php/classes/Query.php") ;
//get an array of student information
$query = new Query("SELECT classes.class_name, grades.student_id, users.username, SUM(grades.correct) as correct, SUM(grades.total) as total, SUM(points) as points
FROM grades, users, quizzes, classes
WHERE users.user_id=grades.student_id AND grades.quiz_id=quizzes.quiz_id AND classes.class_id=quizzes.class_id AND classes.instructor_id=?
GROUP BY grades.student_id",
$user->getId()) ;
$hasStudents = false ;
if ($query->execute() && $query->hasResult()) {
  $hasStudents = true ;
  if (count ($query->getResult() > 1)) {
    $students = $query->getResult() ;
  }
  else {
    $students[0] = $query->getResult() ;
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

    <title>AP Chemistry - Gradebook</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <?php require_once "nav.php" ; ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gradebook</h1>
        <div class="btn-toolbar mb-2 mb-md-0"></div>
      </div>
      <div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Class</th>
              <th scope="col">Student Username</th>
              <th scope="col">Correct</th>
              <th scope="col">Total</th>
              <th scope="col">Average</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($hasStudents) { ?>
              <?php foreach ($students as $student) { ?>
              <tr>
                <td><?php echo $student->class_name ; ?></td>
                <td><a href="student.php?student=<?php echo $student->student_id ; ?>"><?php echo $student->username ; ?></a></td>
                <td><?php echo $student->correct ; ?></td>
                <td><?php echo $student->total ; ?></td>
                <td><?php echo round($student->correct/$student->total*100, 2) ; ?>%</td>
              </tr>
            <?php } ?>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </main>


    <script src="../js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
