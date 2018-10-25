<div id="health">
	<script type="text/javascript">
	//															RECENT: CHANGED P.POSTBODY TO DIV.POSTBODY, WILL UPDATE OTHER PAGES
		var postbodies = [];
		var postnum = 0;
	</script>
  <?php
    include "php/sql.php";

    $result = $db->query("SELECT * FROM posts WHERE tags LIKE '%health%' ORDER BY id DESC");
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
      echo "<p class='postbody healthpost'>"/*.$row['post']*/."</p>";
      echo "</div></div>";
   }
	/*	try {
			echo "<div class='entry' id='links'><div class='author'><b>Admin</b></div><div class='post'><p class='postbody'><h2>Health News</h2>";
			$nootropicsResult = $db->query("SELECT * FROM news WHERE tags LIKE '%nootropics%' ORDER BY id DESC");
			echo "<h3>Nootropics</h3><div class='links'>";
			while ($row = $nootropicsResult->fetch(PDO::FETCH_ASSOC)) {
				echo "<div class='link'>" . $row['date'];
				if (strlen($row['date']) == 3) {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				} else {
					echo "&nbsp;&nbsp;&nbsp;";
				}
				echo "<a href='".$row['url']."' target='_blank'>".$row['title']."</a> — ".$row['author']."</div>";
			}
			echo "</div>";
	
			$pharmaResult = $db->query("SELECT * FROM news WHERE tags LIKE '%pharma%' ORDER BY id DESC");
			echo "<h3>Pharmaceuticals</h3><div class='links'>";
			while ($row = $pharmaResult->fetch(PDO::FETCH_ASSOC)) {
				echo "<div class='link'>" . $row['date'];
				if (strlen($row['date']) == 3) {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				} else {
					echo "&nbsp;&nbsp;&nbsp;";
				}
				echo "<a href='".$row['url']."' target='_blank'>".$row['title']."</a> — ".$row['author']."</div>";
			}
			echo "</div>";

			
			$transhumanismResult = $db->query("SELECT * FROM news WHERE tags LIKE '%transhumanism%' ORDER BY id DESC");
			echo "<h3>Transhumanism</h3><div class='links'>";
			while ($row = $transhumanismResult->fetch(PDO::FETCH_ASSOC)) {
				echo "<div class='link'>" . $row['date'];
				if (strlen($row['date']) == 3) {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				} else {
					echo "&nbsp;&nbsp;&nbsp;";
				}
				echo "<a href='".$row['url']."' target='_blank'>".$row['title']."</a> — ".$row['author']."</div>";
			}
			echo "</div>";
			
			
			$foodconcernsResult = $db->query("SELECT * FROM news WHERE tags LIKE '%food concern%' ORDER BY id DESC");
			echo "<h3>Food-Related Health Concerns</h3><div class='links'>";
			while ($row = $foodconcernsResult->fetch(PDO::FETCH_ASSOC)) {
				echo "<div class='link'>" . $row['date'];
				if (strlen($row['date']) == 3) {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				} else {
					echo "&nbsp;&nbsp;&nbsp;";
				}
				echo "<a href='".$row['url']."' target='_blank'>".$row['title']."</a> — ".$row['author']."</div>";
			}
			echo "</div>";
			
			
			$labmeatResult = $db->query("SELECT * FROM news WHERE tags LIKE '%lab meat%' ORDER BY id DESC");
			echo "<h3>Lab-Grown Meat</h3><div class='links'>";
			while ($row = $labmeatResult->fetch(PDO::FETCH_ASSOC)) {
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

<script type="text/javascript">

	// ADD POSTBODY TEXT TO POSTBODY PARAGRAPHS
/*	var healthpost = 
	for (var i = 0; i < postnum; i++) {
		healthpost[i].innerHTML = postbodies[i];
	}
*/
	$('.healthpost').each(i=>$('.healthpost').eq(i).html(postbodies[i]))
	var linksSection = $('.links');
	var allLinks = $('.link');
	var linksNums = [];
	for (var i = 0; i < (linksSection.length); i++) {
		linksNums[i] = 0;			// GLOBAL VARIABLE LINKSNUMS[] CONTROLS LINKS RANGE DISPLAYED IN EACH SECTION
		var sectionLinksGlobal = linksSection[i].getElementsByClassName('link');
		console.log('pass 1');
		if (sectionLinksGlobal[i]) {
			console.log('pass 2');
			hidelinks(i);
			addLinksPrevNext(i);
			arrows(i);
			showlinks(i);
		}
		console.log("linksSection.length = " + linksSection.length + ", this should run " + linksSection.length-1 + " times -- for loop ran " + i + " times");
	}
;

	//		FOR SOME REASON, FUNCTION STOPS AFTER FIRST SECTION -- CREATELEMENT EXCLUSIVITY?
	function addLinksPrevNext(linksSectionNum) {		// FIRST DEFINITION OF LINKSSECTIONNUM, THE KEY TO LINKSNUMS ARRAY
		console.log("addlinks ran " + linksSectionNum + " times");
		var sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link');
		if (sectionLinks.length > 19) {
			var linksdiv = document.createElement('div');
				linksdiv.classList.add('linksprevnext');
			var prevbutton = document.createElement('a');
				prevbutton.href = "javascript: prevLinks(" + linksSectionNum + ");";
				prevbutton.classList.add('linksprev');
				prevbutton.innerHTML = "<";
			var nextbutton = document.createElement('a');
				nextbutton.href = "javascript: nextLinks(" + linksSectionNum + ");";
				nextbutton.classList.add('linksnext');
				nextbutton.innerHTML = ">";
			linksdiv.appendChild(prevbutton);
			linksdiv.appendChild(nextbutton);
			linksSection[linksSectionNum].appendChild(linksdiv);
		}
	}
	
	function hidelinks(linksSectionNum) {
//		console.log(linksSectionNum);
		var sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link');
		for (var i = 0; i < sectionLinks.length; i++) {
			sectionLinks[i].setAttribute("style", "display:none;");
		}
	}
	
	
	function showlinks(linksSectionNum) {
		var sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link');
		var linksRangeBeginning = linksNums[linksSectionNum];
//		console.log(linksRangeBeginning);
		if (sectionLinks.length > linksRangeBeginning) {
			for (var i = linksRangeBeginning; i < (linksRangeBeginning + 20); i++) {
				if (sectionLinks[i]) {
					sectionLinks[i].setAttribute("style", "");
				}
			}
			linksNums[linksSectionNum] += 20;
//			console.log(linksNums[linksSectionNum]);
		}
	}
	
	function nextLinks(linksSectionNum) {
		var sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link');
		if (linksNums[linksSectionNum] < sectionLinks.length - 1) {
			hidelinks(linksSectionNum);
			showlinks(linksSectionNum);
		}
		arrows(linksSectionNum);
	}
	
	function prevLinks(linksSectionNum) {
		if (linksNums[linksSectionNum] < 21) {
			linksNums[linksSectionNum] -= 20;
		} else if (linksNums[linksSectionNum] > 39) {
			linksNums[linksSectionNum] -= 40;
		}
			hidelinks(linksSectionNum);
			showlinks(linksSectionNum);
			arrows(linksSectionNum);
	}
	
	function arrows(linksSectionNum) {		// DISABLES AND ENABLES LINKS ARROWS
		var sectionLinks = null;
		if (sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link')) {
			console.log('pass 1');
			var prevNextDiv = null;
			for (var i = 0; i < linksSection[linksSectionNum].childNodes.length; i++) {
				if (linksSection[linksSectionNum].childNodes[i].className == "linksprevnext") {
					console.log('pass 2');
					prevNextDiv = linksSection[linksSectionNum].childNodes[i];
					var prevArrow = prevNextDiv.childNodes[0];
					var nextArrow = prevNextDiv.childNodes[1];
					var sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link');
					if (linksNums[linksSectionNum] < 21) {
						prevArrow.classList.add('disabled');
						prevArrow.href = "javascript: void(0);";
						console.log('disable prev');
					} 
					if (linksNums[linksSectionNum] < sectionLinks.length + 20) {
						nextArrow.classList.remove('disabled');
						nextArrow.href = "javascript: nextLinks(" + linksSectionNum + ");";	
						console.log('enable next');
					}
					if (linksNums[linksSectionNum] > sectionLinks.length) {
						nextArrow.classList.add('disabled');
						nextArrow.href = "javascript: void(0);";
						console.log('disable next');
					}
					if (linksNums[linksSectionNum] > 20) {
						prevArrow.classList.remove('disabled');
						prevArrow.href = "javascript: prevLinks(" + linksSectionNum + ");";	
						console.log('enable prev');
					}
					console.log("arrows ran");
				}
			}
		}
	}

/*
		var prevNextDiv = document.getElementsByClassName("linksprevnext");
		var prevArrow = prevNextDiv[linksSectionNum].childNodes[0];
		var nextArrow = prevNextDiv[linksSectionNum].childNodes[1];
		var sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link');
		if (linksNums[linksSectionNum] < 21) {
			prevArrow.classList.add('disabled');
			prevArrow.href = "javascript: void(0);";
		} 
		if (linksNums[linksSectionNum] < sectionLinks.length + 20) {
			nextArrow.classList.remove('disabled');
			nextArrow.href = "javascript: nextLinks(" + linksSectionNum + ");";	
		}
		if (linksNums[linksSectionNum] > sectionLinks.length) {
			nextArrow.classList.add('disabled');
			nextArrow.href = "javascript: void(0);";
		}
		if (linksNums[linksSectionNum] > 20) {
			prevArrow.classList.remove('disabled');
			prevArrow.href = "javascript: nextLinks(" + linksSectionNum + ");";	
		}
		console.log("arrows ran");
	}
	
*/
/*	function create(name, properties) {
		var element = document.createElement(name);
		for (var p in properties)
			element[p] = properties[p];
		return element;
} */

</script>
		
