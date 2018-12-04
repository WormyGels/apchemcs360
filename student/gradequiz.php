<?php
/*
* This page just grades the quiz and puts it in the database
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
//make sure that the variables are set
if (!isset($_POST["answers"], $_POST["quiz"])) {
  header("Location: quizzes.php") ;
}

$answers = $_POST["answers"] ;
$quizId = $_POST["quiz"] ;

//we need to collect an array of the correct answers and then compare user input to those
$query = new Query("SELECT correct_answer FROM quiz_questions WHERE quiz_id=?", $quizId) ;
if ($query->execute() && $query->hasResult()) {
  $result = $query->getResult() ;
}
else {
  echo "There was a problem submitting your quiz." ;
  exit ; //NOTE this is probably not ideal behavior, this message would just be white screen
}
$numCorrect = 0 ;
$numQuestions = count($result) ;

$questions = [] ;
if (count($result) == 1) {
  $questions[0] = $result ;
}
else {
  $questions = $result ;
}

//we have collected these at this point or we are no longer executing
for ($i = 0 ; $i < count($questions) ; $i++) {
  if ($questions[$i]->correct_answer == $answers[$i+1]) {
    $numCorrect++ ;
  }
}
//now insert this information into the DB
$query2 = new Query("INSERT INTO grades (student_id, quiz_id, correct, total) VALUES (?, ?, ?, ?)", array($user->getId(), $quizId, $numCorrect, $numQuestions)) ;
if ($query2->execute()) {
  //redirect
  header("Location: grades.php") ; //TODO NOTE maybe change this to grade.php if that page gets made
}
else {
  echo "There was a problem submitting your quiz." ;
}

?>
