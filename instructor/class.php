<?php
/*
* index page for the instructor when they are logged in
* they will be able to see student progress here
*/

session_start() ;
require_once "../php/UserBundle.php" ;
//if we aren't logged in
if (!isset($_SESSION["user"])) {
  header("Location: ../index.php") ;
}
$user = unserialize($_SESSION["user"]) ;
//we are logged in but not as a teacher
if ($user->type() != 2) {
  header("Location: ../index.php") ;
}
$quizzes = [] ;
//if we are on a valid class
$className = "Error - No class was selected" ;
$joinKey = "Error" ;
if (isset($_GET["class"])) {
  require_once "../php/classes/Query.php" ;
  //ensure that we are accessing one that belongs to us and not another instructor
  $query = new Query("SELECT class_name, join_key FROM classes WHERE class_id=? AND instructor_id=?", array($_GET["class"], $user->getId())) ;
  $query2 = new Query("SELECT quiz_id, quiz_name, quiz_category FROM quizzes WHERE class_id=? ORDER BY quiz_category", $_GET["class"]) ;
  if ($query->execute() && $query->hasResult()) {
    $className = $query->getResult()->class_name ;
    $joinKey = $query->getResult()->join_key ;
    //categories and quizzes
    if ($query2->execute() && $query2->hasResult()) {
      $quizzes = $query2->getResult() ;
    }
  }

}

function _group_by($array, $key) {
    $return = array() ;
    foreach($array as $val) {
        $return[$val[$key]][] = $val ;
    }
    return $return ;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>AP Chemistry - <?php echo $className ; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
    <style>
      .category {
        padding-top: 12px ;
        padding-bottom: 12px ;
        border-bottom: 1px solid #dee2e6 ;
      }
      .section {
        padding-bottom: 24px ;
      }
    </style>
  </head>

  <body>

    <?php require_once "nav.php" ; ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $className ; ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
      <?php
      if (isset($_GET["class"])) {
      ?>
      <div class="container">
        <div class="section">
          <h1 class="h2">Class Info</h1>
          <div class="row">
            <div class="col-sm-12">
              <h1 class="h6">Class Key</h1>
              <input class="form-control" type="text" placeholder="<?php echo $joinKey ; ?>" readonly>
            </div>
          </div>
        </div>
        <div class="section">
          <?php if (count($quizzes) > 0) { ?> <h1 class="h2">Assignments</h1> <?php }
          $previous = "" ;
          foreach ($quizzes as $quiz) {
              if ($quiz->quiz_category != $previous) {
                echo '<div class="row category"><div class="col-sm-12">' ;
                echo '<h1 class="h6">'.$quiz->quiz_category.'</h1>' ;
                $previous = $quiz->quiz_category ;
                echo '<ul class="list-group">' ;
                foreach ($quizzes as $quiznames) {
                  if ($quiznames->quiz_category == $previous) {
                    echo '<li class="list-group-item">'.$quiznames->quiz_name.'</li>' ;
                  }
                }
                echo "</ul></div></div>" ;
              }
          }
          ?>
        </div>
        <?php
        }
        ?>
      </div>
    </main>

    <script src="../js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
