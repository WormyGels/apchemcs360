<?php
/*
* Gets the classes so they can populate a list
*/

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
      <a class="nav-link" href="class.php?class=<?php echo $result->class_id ; ?>">
        <span data-feather="file-text"></span>
        <?php echo $result->class_name ; ?>
      </a>
    </li>
    <?php
  }
}

?>
