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
require_once ("../php/classes/Query.php") ;

if (isset($_GET["student"], $_GET["points"], $_GET["comments"], $_GET["quiz"])) {
  $student = $_GET["student"] ;
  $points = $_GET["points"] ;
  $comments = $_GET["comments"] ;
  $ids = $_GET["quiz"] ;

  for ($i = 0 ; $i < count($ids) ; $i++) {
    $query = new Query("UPDATE grades SET correct=?, comments=? WHERE student_id=? AND quiz_id=?", array($points[$i], $comments[$i], $student, $ids[$i])) ;
    $query->execute() ;
  }


}
if (isset($_GET["student"])) {
  $id = $_GET["student"] ;

  $result = [] ;
  //get an array of quizzes for the student
  $query = new Query("SELECT users.username, grades.quiz_id, correct, total, comments, quiz_name, points
    FROM grades, quizzes, users
    WHERE student_id=? AND quizzes.quiz_id=grades.quiz_id AND users.user_id=grades.student_id
    GROUP BY quiz_id", $id) ;
  if ($query->execute() && $query->hasResult()) {
    $result = $query->getResult() ;
  }

  $grades = [] ;
  if (count($result) == 1) {
    $grades[0] = $result ;
  }
  else {
    $grades = $result ;
  }
  $studentName = $grades[0]->username ;


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
        <h1 class="h2"><?php echo $studentName ; ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0"></div>
      </div>
      <div>
        <form method="get">
          <input type="hidden" name="student" value=<?php echo $id ; ?>>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Quiz Name</th>
                <th scope="col">Correct</th>
                <th scope="col">Questions</th>
                <th scope="col">Points</th>
                <th scope="col">Points Possible</th>
                <th scope="col">Percentage</th>
                <th scope="col">Instructor Feedback</th>
              </tr>
            </thead>
            <tbody>
              <?php if (count($grades) > 0) { ?>
                <?php foreach ($grades as $grade) { ?>
                <tr>
                  <td><?php echo $grade->quiz_name ; ?></td>
                  <td>
                    <div class="form-group">
                      <input name="points[]" type="number" class="form-control col-sm-2" value="<?php echo $grade->correct ; ?>" placeholder="Points" required>
                    </div>
                  </td>
                  <td><?php echo $grade->total ; ?></td>
                  <td><?php echo round($grade->correct/$grade->total, 2)*$grade->points ; ?></td>
                  <td><?php echo $grade->points ; ?></td>
                  <td><?php echo (round($grade->correct/$grade->total*100, 2))."%" ; ?></td>
                  <td>
                    <div class="form-group">
                      <input name="comments[]" type="input" class="form-control" value="<?php echo $grade->comments ; ?>" placeholder="Feedback">
                    </div>
                  </td>
                  <input type="hidden" name="quiz[]" value=<?php echo $grade->quiz_id ; ?>>
                </tr>
              <?php } ?>
            <?php } ?>
            </tbody>
          </table>
          <div class="submit-btn-container">
            <input class="btn btn-secondary" type="submit">
          </div>
        </form>
      </div>
    </main>


    <script src="../js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
