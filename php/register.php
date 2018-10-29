<?php
/*
* register.php
* Handles registration for ALL users
* teachers and administators must also send as special confirmation password in
* order to register
*/

include "classes/Query.php" ;

//when a teacher/admin is registering
if (isset($_GET['username'], $_GET['password'], $_GET['special_key'], $_GET['type'])) {

  include "classes/db.php" ;

  //get all of our variables conveniently
  //TODO peform a check on this vairable to make sure its either 1 (admin) 2 (teacher)
  $type = $_GET['type'] ;
  $username = $_GET['username'] ;
  $password = $_GET['password'] ;
  //hash the password
  $password = hash('ripemd160', $password) ;

  //if the key is valid
  if ($_GET['special_key'] == $specialKey) {

    $query = new Query("INSERT INTO users (user_type, username, password) VALUES (?, ?, ?)", "iss", array($type, $username, $password)) ;
    echo $query->execute() ;

  }

}
//when a student is registering
else if (isset($_GET['username'], $_GET['password'], $_GET['type'])) {

  //get all of our variables conveniently
  //TODO peform a check on this vairable to make sure it is student
  $type = $_GET['type'] ;
  $username = $_GET['username'] ;
  $password = $_GET['password'] ;
  //hash the password
  $password = hash('ripemd160', $password) ;

  $query = new Query("INSERT INTO users (user_type, username, password) VALUES (?, ?, ?)", "iss", array($type, $username, $password)) ;
  echo $query->execute() ;

}

?>
