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
              Status
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>SYSTEM</span>
          <a class="d-flex align-items-center text-muted" href="">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == "changekey.php") echo "active" ; ?>" href="changekey.php">
              <span data-feather="file-text"></span>
              Change Special Key
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>
