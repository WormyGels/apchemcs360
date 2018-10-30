<?php
/*
* Page sends user to correct php page based on what type of user they are
*/

session_start() ;
include "UserBundle.php" ;

//unserialize the incoming object
$user = unserialize($_SESSION["user"]) ;

switch ($user->type()) {
  //admin
  case 1:
    header("Location: ../admin") ;
    break ;
  //instructor
  case 2:
    header("Location: ../instructor") ;
    break ;
  //student
  case 3:
    header("Location: ../student") ;
    break ;
  default:
    header("Location: ../index.html") ;
    break ;

}



?>
