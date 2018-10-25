<?php
$page = $_GET['page'];

if (!empty($page)) {
  
  if ($page == "poetry") {
    include "poetry.php";
  }

  if ($page == "prose") {
    include "prose.php";
  }

  if ($page == "nonfiction") {
    include "nonfiction.php";
  }

  if ($page == "register") {
    include "register.php";
  }

  if ($page == "login") {
    include "login.php";
  }
  
} else {
  include "home.php";
}
?>