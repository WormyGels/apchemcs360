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
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == "grades.php") echo "active" ; ?>" href="grades.php">
              <span data-feather="file"></span>
              Your Grades
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == "quizzes.php") echo "active" ; ?>" href="quizzes.php">
              <span data-feather="shopping-cart"></span>
              View Quizzes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == "notifications.php") echo "active" ; ?>" href="notifications.php">
              <span data-feather="shopping-cart"></span>
              Notifications
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>
