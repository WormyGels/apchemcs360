<?php
/*
* Student object
*/

//takes a student object and checks if they are registered for a class
function inClass($student) {
  require_once "Query.php" ;
  $query = new Query("SELECT * FROM in_class WHERE student_id=?", $student->getId()) ;
  if ($query->execute() && $query->hasResult()) {
    return true ;
  }
  return false ;
}
//gets the class ID that the student is registerd for
function getClass($student) {
  require_once "Query.php" ;
  $query = new Query("SELECT class_id FROM in_class WHERE student_id=?", $student->getId()) ;
  if ($query->execute() && $query->hasResult()) {
    return $query->getResult()->class_id ;
  }
  return null ;
}

class Student implements User {

  private $id ;
  private $username ;

  function __construct($id, $username) {
    $this->id = $id ;
    $this->username = $username ;
  }
  public function getId() {
    return $this->id ;
  }
  public function getUsername() {
    return $this->username ;
  }
  public function type() {
    return 3 ;
  }
}
?>
