<?php
	header('Access-Control-Allow-Origin: https://letteredhorizon.com');
	header('Content-type: application/json');
	// if handling account activation
	if ( (isset($_POST["activation_code"]) && isset($_POST["id"]))
		|| (isset($_GET["activation_code"]) && isset($_GET["id"])) ) {
		include "sql.php";
		$res = array();
		$res['success'] = false;

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$activation_code = $_GET["activation_code"];
		} elseif (isset($_POST['id'])) {
			$id = $_POST["id"];
			$activation_code = $_POST["activation_code"];
		}

		try {
			$result = $db->query("SELECT * FROM users WHERE id = ".$id." AND activation = ".$activation_code.";");
			$row = $result->fetch(PDO::FETCH_ASSOC);
			if (count($row[id]) > 0) {
				try {
					$db->query("UPDATE users SET activation = 1 WHERE id = ".$id.";");
					session_start();
					$_SESSION['username'] = $row[username];
					$_SESSION['email'] = $row[email];

					$res['success'] = true;
					$res['message'] = "Your account was successfully activated.";
					$res['username'] = $row[username];
				} catch (Exception $e) {
					if ($activation_code == 1) {
						$res['success'] = true;
						$res['message'] = "Your account is already activated.";
					} else {
						$res['message'] = "There was a problem updating your account. Please wait and try again, or contact an administrator if this problem persists.";
					}
				}
			} else {
				$res['message'] = "There was a problem matching your account number and activation code. Please request a new activation code or contact an administrator.";
			}
		} catch (Exception $e) {
			$res['message'] = "There was a problem matching your account number and activation code. Please request a new activation code or contact an administrator.";
		}
		// if handling regular login request
	} elseif (isset($_POST['eou']) && isset($_POST['password'])) {
		$eou = stripslashes($_POST['eou']);
		$password = $_POST['password'];

		include "sql.php";

		try {
			$result = $db->query("SELECT id,email,username,password,activation FROM users WHERE username = '".$eou."' OR email = '".$eou."';");
			$row = $result->fetch(PDO::FETCH_ASSOC);
		// if user not found
			if (count($row[username]) == 0 && count($row[email]) == 0) {
				$res['message'] = "Sorry, user not found.";
		// if user found, check password
			} else {
				// if password matches
				if (password_verify($password, $row[password])) {
					// if account is activated
					if ($row[activation] == 1) {
						session_start();
						$_SESSION['username'] = $row[username];
						$_SESSION['email'] = $row[email];
						$res['success'] = true;
						$res['message'] = "Success! {$_SESSION['username']} signed in.";
					// if password matches but account isn't activated
					} else {
						$res['not_activated'] = true;
						$res['message'] = "Activate your account.";
						$res['id'] = $row[id];
					}
				// if password doesn't match
				} else {
					$res['message'] = "Sorry, password is incorrect.";
				}
			}
		} catch (Exception $e) {
			$res['message'] = "Sorry, something went wrong with our database. Notify an administrator for assistance.";
		}
	}
	echo json_encode($res);
?>
