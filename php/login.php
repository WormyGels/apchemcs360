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
    //depending on the specicifity of the query, we can either get an array or just a single object
    //depends on the number of rows you expect to be returned
    echo "User ID: ".$result->user_id."<br>" ; //TODO temporary
    echo "Username: ".$result->username ; //TODO temporary
  }
  else {
    echo "Failure" ;
  }

}

?>
