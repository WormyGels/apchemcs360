<?php

require_once "../php/classes/Query.php" ;

session_start() ;

if (isset($_GET["class_id"], $_SESSION["user"])) {

  $classId = $_GET["class_id"] ;

  $query = new Query("SELECT quiz_category FROM quizzes WHERE class_id=?", $classId) ;
  if ($query->execute() && $query->hasResult()) {
    $result = $query->getResult() ;

    $json = json_encode($result) ;
    echo $json ;
  }

}

?>
