<?php
/*
* Registers the student for a given class key
*
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
if (inClass($user)) {
  header("Location: ../student/index.php") ;
}
//make sure we aren't in a class already
if (!inClass($user) && isset($_POST["class_key"])) {

  $key = $_POST["class_key"] ;

  require_once "classes/Query.php" ;
  //first we find the class id
  $query = new Query("SELECT class_id FROM classes WHERE join_key=?", $key) ;
  if ($query->execute() && $query->hasResult()) {
    $classId = $query->getResult()->class_id ;
    $query2 = new Query("INSERT INTO in_class (student_id, class_id) VALUES (?, ?)", array($user->getId(), $classId)) ;
    if ($query2->execute()) {
      header("Location: ../student/index.php") ;
    }
    else {
      //misc error
      header("Location: ../student/joinclass.php") ; //TODO give them a message
    }
  }
  //the key was invalid
  else {
    header("Location: ../student/joinclass.php") ; //TODO give them a message
  }

}


?>
