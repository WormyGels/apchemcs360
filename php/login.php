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

  $query = new Query("SELECT username, user_id FROM users WHERE username=? AND password=?", array($username, $password)) ;
  if ($query->execute() && $query->hasResult()) {
    $result = $query->getResult() ;
    //depending on the specicifity of the query, we can either get an array or just a single object
    //depends on the number of rows you expect to be returned
    echo "User ID: ".$result->user_id."<br>" ; //TODO temporary
    echo "Username: ".$result->username."<br>" ; //TODO temporary

    //set session variables and redirect them to splash page
    //splash page will decide what page to redirect them to depending on account type
    session_start() ;
    include "UserBundle.php" ;
    $user = new Instructor($result->user_id, $result->username) ;
    //have to seralize objects if we are to make them session variables
    $_SESSION["user"] = serialize(createUser($result->user_id)) ;
    header("Location: splash.php") ;

  }
  else {
    echo "Failure" ;
  }

}

?>
