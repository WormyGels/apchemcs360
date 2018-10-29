<?php
/*
* Query.php
* class that is supposed to handle ALL database connectiveity
* performs the query that you pass to it with constructor
* execute method executes the query and returns apporpriate info
* There query will return 3 of the following possibilities
* 1. A 0 for a failure
* 2. A 1 for success with a no return query
* 3. A json object containing the data in the query
* TODO needs to return that JSON object, the third possibility
*/

class Query {

  private $queryString ;
  private $bindVars = "" ;
  private $variables ;


  //constructor for the class
  function __construct($query, $type = "", $vars = null) {
    $this->queryString = $query ;
    $this->bindVars = $type ;
    $this->variables = $vars ;
  }
  //executes our query
  function execute() {

    include "db.php" ;
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $db) ;

    //if we have no connection error, can prepare the statement
    if (!$conn->connect_error && $stmt = $conn->prepare($this->queryString)) {
      //if we have variables to bind, then we bind them
      if (count($this->variables) > 0) {
        $stmt->bind_param($this->bindVars, ...$this->variables) ;
      }
      //try and execute the statement
      if ($stmt->execute()) {
        //TODO this needs to return stuff IF the query that was passed has something to return
        //this will probably be best done in a json object
        return 1 ;
      }
      else {
        return 0 ;
      }
    }
    else {
      return 0 ;
    }

  }

}


?>
