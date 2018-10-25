<?php
  include "sql.php";

  // IF USERNAME AND PASSWORD ARE NOT EMPTY, ASSIGN VARIABLES
  if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = addslashes($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
  }

  try {     // IF USERNAME NOT TAKEN, GENERATE ACTIVATION CODE, INSERT USER INFO, ECHO SUCCESS MESSAGE
    $activation_code = rand(1000, 10000) * intval(date(g));
	echo "{$username} {$password} {$email} {$activation_code}";
    //$db->query("INSERT INTO users (username, password, email, activation) VALUES ('".$username."', '".$password."', '".$email."', '".$activation_code."');");
    echo "<p class='success'>Success! Check your email for your confirmation code.</p>";

  } catch (Exception $e) {    // IF INSERTION FAILS, ECHO FAILURE MESSAGE
      echo "<p class='failure'>Something went wrong. :,(</p><p>".$e."</p>";
}
  


/*

function checkUsername() {          // RETRIEVE USERNAME AND EMAIL FROM DATABASE ( IF EITHER EXISTS--CHECK BY COUNT()--THROW ERROR)
                                    // IF NO ERROR, ATTEMPT TO INSERT USERNAME/PASSWORD INTO DATABASE
                                    // SEND AUTOMATED EMAIL WITH RANDOM ACTIVATION CODE, STORED IN DATABASE(?)
  $result = $db->query("SELECT username FROM users WHERE username = '".$username."';");
  $checkUser = $result->fetch(PDO::FETCH_ASSOC); 
  $existingUser = $checkUser[username];
  if (count($existingUser) > 0) {
    return true;
  } else {
    return false;
  }
} */


// HOW TO SEND AUTOMATED ACTIVATION EMAIL? RANDOMIZE ACTIVATION NUMBER BASED ON DATE/TIME, TRUNCATE STRING TO 6 DIGITS?

?>