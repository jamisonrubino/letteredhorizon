<?php
  include "sql.php";

  if (!empty($_POST['url']) && !empty($_POST['author']) && !empty($_POST['title'])) {
    $url = $_POST['url'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    
  } else {
    echo "Sorry, no data received.";
  }

  date_default_timezone_set('America/Los_Angeles');

  $hour = date('H');
  if ($hour > 19) {
    $postdate = date("n/d", strtotime('tomorrow'));
  } else {
    $postdate = date("n/d");
  }

  
  
  try {
    for ($i = 0; $i < count($url); $i++) {
			if (!empty($url[$i]) && !empty($title[$i]) && !empty($author[$i])) {
				$linksCode .= $postdate."&nbsp;&nbsp;&nbsp;<a target='_blank' href='".$url[$i]."'>@ ".$title[$i]."</a> – ".$author[$i]."<br> @";
			}
		}
  } catch (Exception $e) {
    echo "Something went wrong: ".$e;
  }
?>

<div id="linksCode">


</div>

<script type="text/javascript">
	var linksCode = <?php echo json_encode($linksCode); ?>;
	var linksCodeDiv = document.getElementById('linksCode');
	
	var linksCodeWithBreaks = linksCode.split(/@/);
	
	for (var i = 0; i < linksCodeWithBreaks.length; i++) {
		linksCodeDiv.innerText += linksCodeWithBreaks[i]+"\n";
	}
	// var linksText = document.createTextNode(linksCode);
	// linksCodeDiv.appendChild(linksText);
	
</script>