<?php
//file returns quiz info as packed json

session_start() ;
require_once "../php/UserBundle.php" ;
require_once "../php/classes/Query.php" ;
$user = unserialize($_SESSION["user"]) ;

if (isset($user) && isset($_GET["quiz"])) {
  $quizId = $_GET["quiz"] ;

  $query = new Query("SELECT grades.quiz_id, quiz_name, correct, total, comments FROM grades, quizzes WHERE grades.quiz_id=? AND grades.quiz_id=quizzes.quiz_id GROUP BY quiz_id", $quizId) ;
  if ($query->execute() && $query->hasResult()) {
    $result = $query->getResult() ;

    $name = $result->quiz_name ;
    $correct = $result->correct ;
    $total = $result->total ;
    $comment = $result->comments ;

    //going to store these in an object, then encode them with json
    $jsonObj = new \stdClass() ; //this is necessary to supress a warning
    $jsonObj->name = $name ;
    $jsonObj->correct = $correct ;
    $jsonObj->total = $total ;
    $jsonObj->comment = $comment ;

    //encode with json then echo it (javascript can interpret this really nicely)
    $json = json_encode($jsonObj) ;
    echo $json ;

  }
  else {
    echo "err1" ;
    exit ;
  }

}
else {
  echo "err2" ;
  exit ;
}


?>
