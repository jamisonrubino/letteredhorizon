<div id="home">
	<script type="text/javascript">
		var postbodies = [];
		var postnum = 0;
	</script>
  <?php
    session_start();
    include "php/sql.php";
	echo "<h2 class='page-title'>Recent Posts</h2>";
    $result = $db->query("SELECT * FROM posts ORDER BY id DESC");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	?>
	<script type="text/javascript">
		postbodies[postnum] = <?php echo json_encode($row['post']); ?>;
		postnum++;
	</script>
	<?php
      echo "<div class='entry'>";
			$tags = explode(",", $row['tags']);
			sort($tags);
			$tags = implode(", ", $tags);
			$edit = "";
			if (!empty($_SESSION['username'] && $row['author'] == $_SESSION['username'])) {            // IF AUTHOR OF POST, ADD EDIT BUTTON
				$edit = "<br><a href='javascript: void(0)' class='edit-link' data-post-id='".$row['id']."'>Edit</a>";
			}
      echo "<div class='author'><b>".$row['author']."</b><br><span class='time'>".$row['date']."</span><br><span class='tags'>".$tags.$edit;

      echo "</div>";
      echo "<div class='post'>";
      echo "<h3>".$row['title']."</h3>";
      echo "<p class='postbody'>"/*.$row['post']*/."</p>";
      echo "</div></div>";
    }
    echo "<div style='clear: both;'><br></div>";
  ?>
  <div id="prevnext">
    <a href="javascript: prevPost();" id="prev">PREV</a>
    <a href="javascript: nextPost();" id="next">NEXT</a>
  </div>
</div>

<script type="text/javascript" src="js/limitposts.js"></script>
<script type="text/javascript">
		// ADD POSTBODY TEXT TO POSTBODY PARAGRAPHS
	var postdiv = document.getElementsByClassName('postbody');
	for (var i = 0; i < postnum; i++) {
		postdiv[i].innerHTML = postbodies[i];
	}
</script>
