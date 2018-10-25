<?php
  include "sql.php";
  $username = strtolower($_POST['username']);
  $result = $db->query("SELECT * FROM users WHERE username = '".$username."';");
  $row = $result->fetch(PDO::FETCH_ASSOC);
  if (count($row[username]) > 0) {
    echo "failure";
  } else {
    echo "success";
  }
?>
