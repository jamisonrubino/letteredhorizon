<?php
session_start();

include "sql.php";

$username = stripslashes($_POST['username']);
$password = $_POST['password'];

try {
  $result = $db->query("SELECT * FROM users WHERE username = '".$username."';");
  $row = $result->fetch(PDO::FETCH_ASSOC);

  if (count($row[username]) == 0) {
    echo "<p class='loginfail'>Sorry, username not found.</p>";
  } else {
    $pass_hash = password_hash($row[password], PASSWORD_DEFAULT);
    if (password_verify($password, $pass_hash)) {
      if ($row[activated] == "yes") {
        $_SESSION['username'] = $row[username];
        $_SESSION['email'] = $row[email];
        echo $_SESSION['username']." signed in.";
      } else {
        echo "<p class='loginfail'>Your account is not activated yet.</p>";
      }
    } else {
      echo "<p class='loginfail'>Sorry, username or password is incorrect.</p>" . $pass_hash . " " . $password;
    }
  }

} catch (Exception $e) {
  echo "<p class='loginfail'>Sorry, something went wrong.</p>";
}

?>

<script type="text/javascript">
  window.onload = function() {
    setTimeout(window.location.assign('https://www.letteredhorizon.com'), 5000);
  }
</script>
