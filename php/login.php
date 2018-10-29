<?php
/*
* login.php
* handles logins for all users
*/

include "classes/Query.php" ;

//this is just a test page at the moment

$query = new Query("SELECT username, password FROM users") ;
if ($query->execute()) {
  print_r($query->getResult()) ;
}
else {
  echo "failure" ;
}




?>
