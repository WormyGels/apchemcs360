<?php
/*
* index page for the student when they are logged in
* here they will see their own progress and anything they have yet to do
*/

session_start() ;
require_once "../php/UserBundle.php" ;
//if we aren't logged in
if (!isset($_SESSION["user"])) {
  header("Location: ../index.php") ;
}
$user = unserialize($_SESSION["user"]) ;
//we are logged in but not as a student
if ($user->type() != 3) {
  header("Location: ../index.php") ;
}
if (!inClass($user)) {
  header("Location: joinclass.php") ;
}
//check to see if get variable is set
//just redirect them if it isnt
if (!isset($_GET["quiz"])) {
  header("Location: quizzes.php") ;
}
$quizId = $_GET["quiz"] ;
//an additional check of whether or not they have already taken the quiz OR the quiz isn't for their class is required
//just redirect them
if (hasTakenQuiz($user, $quizId) || !hasQuiz($user, $quizId)) {
  //TODO maybe take them to grade page if they already took quiz instead of just flipping them back
  header("Location: grade.php?quiz=".$quizId) ;
}

//pull in the data for the quiz
$quizInfoQuery = new Query("SELECT quiz_name FROM quizzes WHERE quiz_id=?", $quizId) ;
$quizQuestionsQuery = new Query("SELECT question_text, ans1_text, ans2_text, ans3_text, ans4_text, ans5_text, ans6_text FROM quiz_questions WHERE quiz_id=?", $quizId) ;

$title = "" ;
$questions = [] ;
if ($quizInfoQuery->execute() && $quizInfoQuery->hasResult() && $quizQuestionsQuery->execute() && $quizQuestionsQuery->hasResult()) {
  $title = $quizInfoQuery->getResult()->quiz_name ;
  $result = $quizQuestionsQuery->getResult() ;
}
else {
  echo "There was an issue getting the quiz." ;
  //don't display page to them in this weird niche case
  exit ;
}

$questions = [] ;
if (count($result) == 1) {
  $questions[0] = $result ;
}
else {
  $questions = $result ;
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

    <title>AP Chemistry - <?php echo $title ; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <link href="../css/main.css" rel="stylesheet">

  </head>

  <body>
    <?php require_once "nav.php" ; ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $title ; ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0"></div>
      </div>
      <div class="quiz">
        <form method="post" action="gradequiz.php">
          <input type="hidden" name="quiz" value="<?php echo $quizId ; ?>">
          <?php $questionCount = 1 ;?>
          <?php foreach ($questions as $question) { ?>
          <div class="question">
            <h6 class="question-title"><?php echo $question->question_text ; ?></h6>
            <div class="btn-group-toggle col-sm-12" data-toggle="buttons">
              <label class="btn btn-secondary radio active">
                <input type="radio" name="answers[<?php echo $questionCount ; ?>]" autocomplete="off" value=1 checked> A
              </label>
              <span class="question-answer"><?php echo $question->ans1_text ; ?></span><br>
              <label class="btn btn-secondary radio">
                <input type="radio" name="answers[<?php echo $questionCount ; ?>]" autocomplete="off" value=2> B
              </label>
              <span class="question-answer"><?php echo $question->ans2_text ; ?></span><br>
              <label class="btn btn-secondary radio">
                <input type="radio" name="answers[<?php echo $questionCount ; ?>]" autocomplete="off" value=3> C
              </label>
              <span class="question-answer"><?php echo $question->ans3_text ; ?></span><br>
              <label class="btn btn-secondary radio">
                <input type="radio" name="answers[<?php echo $questionCount ; ?>]" autocomplete="off" value=4> D
              </label>
              <span class="question-answer"><?php echo $question->ans4_text ; ?></span><br>
              <label class="btn btn-secondary radio">
                <input type="radio" name="answers[<?php echo $questionCount ; ?>]" autocomplete="off" value=5> E
              </label>
              <span class="question-answer"><?php echo $question->ans5_text ; ?></span><br>
              <label class="btn btn-secondary radio">
                <input type="radio" name="answers[<?php echo $questionCount ; ?>]" autocomplete="off" value=6> F
              </label>
              <span class="question-answer"><?php echo $question->ans6_text ; ?></span><br>
            </div>
          </div>
          <?php $questionCount++ ;?>
        <?php } ?>

          <div class="submit-btn-container">
            <input class="btn btn-secondary" type="submit">
          </div>
        </form>
      </div>
    </main>


    <script src="../js/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
