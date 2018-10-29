<?php
/*
* login.php
* handles logins for all users
*/

include "classes/Query.php" ;

//make sure we have both username and password set
if (isset($_POST['username'], $_POST['password'])) {

  //get variables conveniently
  $username = $_POST['username'] ;
  $password = $_POST['password'] ;
  $password = hash('ripemd160', $password) ;

  $query = new Query("SELECT username, user_id FROM users WHERE username=? AND password=?", "ss", array($username, $password)) ;
  if ($query->execute() && $query->hasResult()) {
    $result = $query->getResult() ;
    //remember result is always an array
    echo "User ID: ".$result[0]->user_id."<br>" ; //TODO temporary
    echo "Username: ".$result[0]->username ; //TODO temporary
  }
  else {
    echo "Failure" ;
  }

}

?>
