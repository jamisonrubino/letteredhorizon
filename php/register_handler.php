<?php
  header('Access-Control-Allow-Origin: https://letteredhorizon.com');
  header('Content-type: application/json');
  set_include_path('/home/jkrubino/letteredhorizon.com/');
  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  if ( count($_POST['username']) > 0 && count($_POST['password']) > 0 && count($_POST['email']) > 0 ) {
    $res = array();
    $res['success'] = false;

    $email = $_POST["email"];
    $username = addslashes($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $activation_code = rand(1000, 10000) * intval(date(g));

    include "sql.php";

    $result = $db->query("SELECT * FROM users WHERE username = '" . $username . "' OR email = '" . $email . "';");
    $row = $result->fetch(PDO::FETCH_ASSOC);
    // if username or email taken
    if (count($row[username]) > 0) {
      echo $row[username];
      $res['message'] = "Sorry, that username or email is taken.";
    //if username or email not taken
    } else {
      try {     // IF USERNAME NOT TAKEN, GENERATE ACTIVATION CODE, INSERT USER INFO, ECHO SUCCESS MESSAGE
        $db->query("INSERT INTO users (username, password, email, activation, role) VALUES ( '".$username."', '".$password."', '".$email."', ".$activation_code.", 'user' );");
        sleep(2);
        $result = $db->query("SELECT id,activation FROM users WHERE email = '" . $email . "';");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $id = $row[id];
      } catch (Exception $e) {    // IF INSERTION FAILS, ECHO FAILURE MESSAGE
        $res['message'] = "Something went wrong with our database. :,( {$e->getMessage()}";
      }

      $body = "<h1>Welcome to LetteredHorizon!</h1><h3>To get started, activate your account.</h3>";
      $body .= "Your activation code is <b>".$activation_code."</b>. <br><a href='https://letteredhorizon.com/Login' target='_blank'>Log in</a> or <a href='https://letteredhorizon.com/login_handler.php?id=".$id."&activation_code=".$activation_code."' target='_blank'>follow this link to complete your registration.</a>";

      $altbody = "Welcome to LetteredHorizon! \n\nTo get started, activate your account.\n\n";
      $altbody .= "Your activation code is".$activation_code.". \nLog in at https://letteredhorizon.com/Login or follow this link to complete your registration: https://letteredhorizon.com/login_handler.php?id=".$id."&activation_code=".$activation_code;

      try {
        $mailer = new PHPMailer(true);
        $mailer->SMTPDebug = 0;
        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->Username = 'mailer.letteredhorizon@gmail.com';
        $mailer->Password = 'wRodewr9gExAwru1_36w5!withac3Yi-';
        $mailer->SMTPSecure = 'tls';
        $mailer->Port = 587;

        $mailer->setFrom('mailer.letteredhorizon@gmail.com', 'LetteredHorizon');
        $mailer->addAddress($email, $username);
        $mailer->addReplyTo('mailer.letteredhorizon@gmail.com', 'LetteredHorizon Mailer');
        $mailer->isHTML(true);
        $mailer->Subject = 'Welcome to LetteredHorizon! Activate your account.';
        $mailer->Body    = $body;
        $mailer->AltBody = $altbody;
        $mailer->send();

        $res['message'] = "Success! Please check your inbox for your confirmation email.";
        $res['success'] = true;
      } catch (Exception $e) {
        $res['message'] = "Something went wrong with our mailing system. :( \n{$e}";
      }
    }
    echo json_encode($res);
  }
?>
