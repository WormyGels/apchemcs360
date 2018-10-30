<?php
/*
* register.php
* Handles registration for ALL users
* teachers and administators must also send as special confirmation password in
* order to register
* //TODO needs to not register users with the same name
*/

include "classes/Query.php" ;

//when a teacher/admin is registering
if (isset($_POST['username'], $_POST['password'], $_POST['special_key'], $_POST['type']) && $_POST['special_key'] != "") {

  include "classes/db.php" ;

  //get all of our variables conveniently
  //TODO peform a check on this vairable to make sure its either 1 (admin) 2 (teacher)
  $type = $_POST['type'] ;
  $username = $_POST['username'] ;
  $password = $_POST['password'] ;
  //hash the password
  $password = hash('ripemd160', $password) ;

  //if the key is valid
  if ($_POST['special_key'] == $specialKey) {

    $query = new Query("INSERT INTO users (user_type, username, password) VALUES (?, ?, ?)", array($type, $username, $password)) ;
    if ($query->execute()) {
      echo "Success" ;
      //redirect to login
    }
    else {
      echo "Failure" ;
      //redirect to register page
    }

  }
  else {
    echo "Failure, bad key" ;
  }

}
//when a student is registering
else if (isset($_POST['username'], $_POST['password'], $_POST['type'])) {

  //get all of our variables conveniently
  //TODO peform a check on this vairable to make sure it is student
  $type = $_POST['type'] ;
  $username = $_POST['username'] ;
  $password = $_POST['password'] ;
  //hash the password
  $password = hash('ripemd160', $password) ;

  $query = new Query("INSERT INTO users (user_type, username, password) VALUES (?, ?, ?)", array($type, $username, $password)) ;
  if ($query->execute()) {
    echo "Success" ;
  }
  else {
    echo "Failure" ;
  }

}

?>
