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
      //log them in
      $query2 = new Query("SELECT username, user_id FROM users WHERE username=? AND password=?", array($username, $password)) ;
      if ($query2->execute() && $query2->hasResult()) {
        $result = $query2->getResult() ;
        //depending on the specicifity of the query, we can either get an array or just a single object
        //depends on the number of rows you expect to be returned

        //set session variables and redirect them to splash page
        //splash page will decide what page to redirect them to depending on account type
        session_start() ;
        include "UserBundle.php" ;
        //have to seralize objects if we are to make them session variables
        $_SESSION["user"] = serialize(createUser($result->user_id)) ;
        header("Location: splash.php") ;

      }
    }
    else {
      //redirect to register page
      header("Location: ../register.php") ;

    }

  }
  else {
    header("Location: ../register.php?fail=1") ;
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

    //log them in
    $query2 = new Query("SELECT username, user_id FROM users WHERE username=? AND password=?", array($username, $password)) ;
    if ($query2->execute() && $query2->hasResult()) {
      $result = $query2->getResult() ;
      //depending on the specicifity of the query, we can either get an array or just a single object
      //depends on the number of rows you expect to be returned

      //set session variables and redirect them to splash page
      //splash page will decide what page to redirect them to depending on account type
      session_start() ;
      include "UserBundle.php" ;
      //have to seralize objects if we are to make them session variables
      $_SESSION["user"] = serialize(createUser($result->user_id)) ;
      header("Location: splash.php") ;

    }

  }
  else {
    header("Location: ../index.php") ;

  }

}

?>
