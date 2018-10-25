<div id="money">
  <script type="text/javascript">
  //															RECENT: CHANGED P.POSTBODY TO DIV.POSTBODY, WILL UPDATE OTHER PAGES
    var postbodies = [];
    var postnum = 0;
  </script>
  <?php
    include "php/sql.php";

    $result = $db->query("SELECT * FROM posts WHERE tags LIKE '%money%' ORDER BY id DESC");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  ?>
  <script type="text/javascript">
    postbodies[postnum] = <?php echo json_encode($row['post']); ?>;
    postnum++;
  </script>
  <?php
      echo "<div class='entry'>";
      echo "<div class='author'><b>".$row['author']."</b><br><span class='time'>".$row['date']."</span></div>";
      echo "<div class='post'>";
      echo "<h3>".$row['title']."</h3>";
      echo "<p class='postbody moneypost'>{$row[post]}</p>";
      echo "</div></div>";
   }
	/*	try {
			echo "<div class='entry' id='links'><div class='author'><b>Admin</b></div><div class='post'><p class='postbody'><h2>Money News</h2>";
			$moneyResult = $db->query("SELECT * FROM news WHERE tags LIKE '%investing%' ORDER BY id DESC");
			echo "<h3>Crowdfunds/Startups</h3><div class='links'>";
			while ($row = $moneyResult->fetch(PDO::FETCH_ASSOC)) {
				echo "<div class='link'>" . $row['date'];
				if (strlen($row['date']) == 3) {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				} else {
					echo "&nbsp;&nbsp;&nbsp;";
				}
				echo "<a href='".$row['url']."' target='_blank'>".$row['title']."</a> — ".$row['author']."</div>";
			}
			echo "</div>";


			$securitiesResult = $db->query("SELECT * FROM news WHERE tags LIKE '%securities%' ORDER BY id DESC");
			echo "<h3>Stable Securities</h3><div class='links'>";
			while ($row = $securitiesResult->fetch(PDO::FETCH_ASSOC)) {
				echo "<div class='link'>" . $row['date'];
				if (strlen($row['date']) == 3) {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				} else {
					echo "&nbsp;&nbsp;&nbsp;";
				}
				echo "<a href='".$row['url']."' target='_blank'>".$row['title']."</a> — ".$row['author']."</div>";
			}
			echo "</div>";

			echo "</p></div></div>";
		} catch (Exception $e) {
			echo "Sorry, news could not be displayed. Please try again later.";
		}
		*/
		echo "<div style='clear: both;'><br></div>";

  ?>
  <div id="prevnext">
    <a href="javascript: prevPost();" id="prev">PREV</a>
    <a href="javascript: nextPost();" id="next">NEXT</a>
  </div>
</div>

<script type="text/javascript" src="js/limitposts.js"></script>

<script type="text/javascript" src="paginateLinks.js">
	paginateLinks(moneypost);
</script>
