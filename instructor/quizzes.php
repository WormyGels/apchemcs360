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

require_once("../php/classes/Query.php") ;

$query = new Query("SELECT class_name, class_id FROM classes WHERE instructor_id=?", $user->getId()) ;
$query->execute() ;

//redirect them to assignment page for the just created quiz
if (isset($_POST["question"], $_POST["quiz_name"], $_POST["class_id"])) {

//add question to database and then retrieve the quiz id to redirect them
//add questions to database in loop
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

    <style>
      .separator {
        border: 1px solid gray ;
        padding: 10px ;
      }
    </style>

    <title>AP Chemistry - Create a Quiz</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <?php require_once "nav.php" ; ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create a Quiz</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
      <div class="container col-sm-10">
        <?php
        //user has classes
        if ($query->hasResult()) {
        ?>
        <form autocomplete="off" method="post">
          <div class="align-items-center">
            <div class="form-group col-sm-12 separator">
              <label>Class</label>
              <select name="class_id" class="custom-select">
                <?php
                if ($query->hasResult()) {
                  $result = $query->getResult() ;
                  if (count($result) > 1) {
                    foreach ($query->getResult() as $index) {
                      echo "<option value=".$index->class_id.">".$index->class_name."</option>" ;
                    }
                  }
                  else {
                    echo "<option value=".$query->getResult()->class_id.">".$query->getResult()->class_name."</option>" ;
                  }
                }
                ?>
              </select>
            </div>
            <div id="quizName" class="form-group col-sm-12 separator question-box">
              <div class="form-row">
                <div class="col-sm-12">
                  <label>Quiz Name</label>
                  <input name="quiz_name" type="text" class="form-control" placeholder="Quiz Name">
                </div>
              </div>
            </div>
            <div id="question1" class="form-group col-sm-12 separator question-box">
              <div class="form-row">
                <div class="col-sm-12">
                  <label>Question 1</label>
                  <input name="question[]" type="text" class="form-control" placeholder="Question">
                </div>
                <div class="col-sm-2">
                  <label>A</label>
                  <input name="answera[]" type="text" class="form-control" placeholder="A">
                </div>
                <div class="col-sm-2">
                  <label>B</label>
                  <input name="answerb[]" type="text" class="form-control" placeholder="B">
                </div>
                <div class="col-sm-2">
                  <label>C</label>
                  <input name="answerc[]" type="text" class="form-control" placeholder="C">
                </div>
                <div class="col-sm-2">
                  <label>D</label>
                  <input name="answerd[]" type="text" class="form-control" placeholder="D">
                </div>
                <div class="col-sm-2">
                  <label>E</label>
                  <input name="answere[]" type="text" class="form-control" placeholder="E">
                </div>
                <div class="col-sm-2">
                  <label>F</label>
                  <input name="answerf[]" type="text" class="form-control" placeholder="F">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <button type="button" id="newQuestion" class="btn btn-lg btn-primary btn-block">Add Another Question</button>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Create Quiz</button>
              </div>
            </div>
          </div>
        </form>
        <?php
        }
        //user has no classes
        else {
          ?>
            <h1 class="h2">No Classes</h1>
          <?php
        }
        ?>
      </div>
    </main>

    <script src="../js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/instructor/new-quiz.js" crossorigin="anonymous"></script>

  </body>
</html>
