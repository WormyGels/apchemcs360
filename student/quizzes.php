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

//get a list of the quizzes for the class that the student has not taken
$noQuiz = false ;
$result = [] ;
//NOTE this currently displays all quizzes not just the ones that aren't taken by the student, will probably change this later
$query = new Query("SELECT quiz_id, quiz_name, quiz_category FROM quizzes WHERE class_id=?", getClass($user)) ;
if ($query->execute() && $query->hasResult()) {
  $result = $query->getResult() ;

}
else {
  $noQuiz = true ;
}

$quizzes = [] ;
//it always needs to be an array
if (count($result) == 1) {
  $quizzes[0] = $result ;
}
else {
  $quizzes = $result ;
}

//create a list of the categories
$categories = [] ;
foreach ($quizzes as $quiz) {
  if (!in_array($quiz->quiz_category, $categories)) {
    $categories[] = $quiz->quiz_category ;
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

    <title>AP Chemistry - View Quizzes</title>

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
        <h1 class="h2">Current Quizzes</h1>
        <div class="btn-toolbar mb-2 mb-md-0"></div>
      </div>
      <div class="section">
          <?php
          //no quiz message
            if ($noQuiz) echo "<h6>No quizzes available at this time.</h6>" ;
            else {
              foreach ($categories as $category) {
                echo '<div class="row category"><div class="col-sm-12">' ;
                echo '<h1 class="h6">'.$category.'</h1>' ;
                echo '<ul class="list-group">' ;
                //populate the list
                foreach ($quizzes as $quiz) {
                  if ($quiz->quiz_category == $category) {
                    echo '<li class="list-group-item"><a href="takequiz.php?quiz='.$quiz->quiz_id.'">'.$quiz->quiz_name.'</a></li>' ;
                  }
                }
                //close the elements up
                echo "</ul></div></div>" ;
              }
            }
          ?>
      </div>
    </main>


    <script src="../js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
