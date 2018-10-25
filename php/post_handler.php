<?php
session_start();
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  include "sql.php";
  // if existing post selected
  if (!isset($_GET['querytype'])) {
	// if deleting existing post
    if (isset($_POST['del'])) {
        $id = $_POST['id'];
        try {
          $db->query("DELETE FROM posts WHERE id = ".$id.";");
		  echo "Success! Your post is gone.";
        } catch (Exception $e) {
          echo "There was a problem deleting your post. Sorry!";
        }
	// if updating existing post
    } else {
	  $title = addslashes($_POST['title']);
	  $postbody = addslashes($_POST['postbody']);
	  $tag = $_POST['tag'];
	  $date = date('M j\, Y');

      try {
        $db->query("INSERT INTO posts (title, post, author, tags, date) VALUES ('".$title."', '".$postbody."', '".$username."', '".$tag."', '".$date."')");
        echo "Success! INSERT INTO posts (title, post, author, tags, date) VALUES ('".$title."', '".$postbody."', '".$username."', '".$tag."', '".$date."')";
      } catch (Exception $e) {
        echo "<p class='error'>Sorry, something went wrong.</p>";
        echo "<p>You can still save the contents of your post:</p>";
        echo "<h3>".$title."</h3>";
        echo "<p>".$postbody."</p>";
		echo "<p>{$tag} {$username} {$date}</p>";
      }
    }
  // if creating new post
  } elseif ($_GET['querytype'] == 1) {
      $id = $_POST['id'];
	  $title = addslashes($_POST['title']);
	  $postbody = addslashes($_POST['postbody']);
	  $tag = $_POST['tag'];
	  $date = date('M j\, Y');
    try {
      $db->query("UPDATE posts SET title = '".$title."', post = '".$postbody."', author = '".$username."', tags = '".$tag."', date = '".$date."' WHERE id = ".$id.";");
      echo "Success! UPDATE posts SET title = '".$title."', post = '".$postbody."', username = '".$username."', tags = '".$tag."', date = '".$date."' WHERE id = ".$id.";";

    } catch (Exception $e) {
      echo $e;
      echo $id;
      echo "UPDATE posts SET title = '".$title."', post = '".$postbody."', username = '".$username."', tags = '".$tag."', date = '".$date."' WHERE id = ".$id.";";
      echo "<p class='error'>Sorry, something went wrong.</p>";
      echo "<p>You can still save your work, though:</p>";
      echo "<h3>".$title."</h3>";
      echo "<p>".$postbody."</p>";
    }

  }
}
?>
