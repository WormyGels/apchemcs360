<?php
/*
* User interface
* Will have the three types, student, instructor, and admin
*/

//factory function that creates and returns proper user by querying database
function createUser($id) {

  $query = new Query("SELECT user_id, username, user_type FROM users WHERE user_id=?", $id) ;
  if ($query->execute() && $query->hasResult()) {
    $result = $query->getResult() ;

    switch ($result->user_type) {
      //admin
      case 1:
        return new Administrator($result->user_id, $result->username) ;
        break ;
      //instructor
      case 2:
        return new Instructor($result->user_id, $result->username) ;
        break ;
      case 3:
        return new Student($result->user_id, $result->username) ;
        break ;
      default:
        return null ;
        break ;
    }
  }
  else {
    return null ;
  }

}


interface User {

  public function getId() ;
  public function getUsername() ;
  public function type() ;
}



?>
