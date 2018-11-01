<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">AP Chemistry</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="../logout.php">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == "index.php") echo "active" ; ?>" href="index.php">
              <span data-feather="home"></span>
              Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == "grades.php") echo "active" ; ?>" href="grades.php">
              <span data-feather="file"></span>
              Gradebook
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == "quizzes.php") echo "active" ; ?>" href="quizzes.php">
              <span data-feather="shopping-cart"></span>
              Create a Quiz
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>VIEW ASSIGNMENTS</span>
          <a class="d-flex align-items-center text-muted" href="">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <?php
          $user = unserialize($_SESSION["user"]) ;
          require_once "../php/classes/Query.php" ;
          $query = new Query("SELECT class_name, class_id FROM classes WHERE instructor_id=?", $user->getId()) ;
          $urlClass = 0 ;
          if (isset($_GET["class"])) {
            $urlClass = $_GET["class"] ;
          }
          if ($query->execute() && $query->hasResult()) {
            $result = $query->getResult() ;

            if (count($result) > 1) {
              foreach ($result as $index) {
                ?>
                <li class="nav-item">
                  <a class="nav-link <?php if ($urlClass == $index->class_id) echo "active" ; ?>" href="class.php?class=<?php echo $index->class_id ; ?>">
                    <span data-feather="file-text"></span>
                    <?php echo $index->class_name ; ?>
                  </a>
                </li>
                <?php
              }
            }
            else {
              ?>
              <li class="nav-item">
                <a class="nav-link <?php if ($urlClass == $result->class_id) echo "active" ; ?>" href="class.php?class=<?php echo $result->class_id ; ?>">
                  <span data-feather="file-text"></span>
                  <?php echo $result->class_name ; ?>
                </a>
              </li>
              <?php
            }
          }

          ?>
        <li class="nav-item">
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == "newclass.php") echo "active" ; ?>" href="newclass.php">
            <span data-feather="file-text"></span>
            Create a New Class
          </a>
        </li>
        </ul>
      </div>
    </nav>
  </div>
</div>
