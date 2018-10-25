<div id="nonfiction">
  <?php
    include "php/sql.php";

    $result = $db->query("SELECT * FROM posts WHERE tags = 'nonfiction' ORDER BY id DESC");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      echo "<div class='entry'>";
      echo "<div class='author'><b>".$row['username']."</b><br><span class='time'>".$row['date']."</span></div>";
      echo "<div class='post'>";
      echo "<h3>".$row['title']."</h3>";
      echo "<p class='postbody'>".$row['post']."</p>";
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