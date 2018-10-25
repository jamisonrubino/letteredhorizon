<head>
	<link rel="stylesheet" type="text/css" href="links.css">
</head>

<div id='addLinks'>
  <form action="alt-showlinks.php" method="post">
   <!-- <textarea id='rawURLs' rows="20" cols="100"></textarea> -->
		
		<!--
<input type="checkbox" name="category" value="Best Of The Web">Best of the Web<br>
<input type="checkbox" name="category" value="The Economy">The Economy<br>
<input type="checkbox" name="category" value="Precious Metals">Precious Metals<br>
<input type="checkbox" name="category" value="Inflation, Deflation, Currency War, Cryptocurrencies">Inflation, Deflation, Currency War, Cryptocurrencies<br>
<input type="checkbox" name="category" value="Real Estate Bubble">Real Estate Bubble<br>
<input type="checkbox" name="category" value="DollarCollapse Podcasts">DollarCollapse Podcasts<br>
<input type="checkbox" name="category" value="Ron Paul, Rand Paul, Elizabeth Warren, Bernie Sanders">Ron Paul, Rand Paul, Elizabeth Warren, Bernie Sanders<br>
<input type="checkbox" name="category" value="Offshore Investing">Offshore Investing<br>
<input type="checkbox" name="category" value="Clean Tech">Clean Tech<br>
<input type="checkbox" name="category" value="Art Of The Collapse">Art Of The Collapse<br>
<input type="checkbox" name="category" value="War">War<br>
<input type="checkbox" name="category" value="Self-sufficiency, Food Security, Survival">Self-sufficiency, Food Security, Survival<br>
<input type="checkbox" name="category" value="CyberWar, CyberTerrorism, CyberCrime">CyberWar, CyberTerrorism, CyberCrime<br>
<input type="checkbox" name="category" value="Off-Topic But Brilliant/Challenging/Infuriating">Off-Topic But Brilliant/Challenging/Infuriating<br>
	

    <select name="category" id="category">
      <option value="unset"> </option>
      <option value="Best of the Web">Best of the Web</option>
      <option value="The Economy">The Economy</option>      
      <option value="Precious Metals">Precious Metals</option>      
      <option value="Inflation, Deflation, Currency War, Cryptocurrencies">Inflation, Deflation, Currency War, Cryptocurrencies</option>      
      <option value="Real Estate Bubble">Real Estate Bubble</option>      
      <option value="DollarCollapse Podcasts">DollarCollapse Podcasts</option>      
      <option value="Ron Paul, Rand Paul, Elizabeth Warren, Bernie Sanders">Ron Paul, Rand Paul, Elizabeth Warren, Bernie Sanders</option>    
      <option value="Offshore Investing">Offshore Investing</option>      
      <option value="Clean Tech">Clean Tech</option>      
      <option value="Art of the Collapse">Art of the Collapse</option>      
      <option value="War">War</option>      
      <option value="Self-sufficiency, Food Security, Survival">Self-sufficiency, Food Security, Survival</option>      
      <option value="CyberWar, CyberTerrorism, CyberCrime">CyberWar, CyberTerrorism, CyberCrime</option>      
      <option value="Off-Topic But Brilliant/Challenging/Infuriating">Off-Topic But Brilliant/Challenging/Infuriating</option>          
    </select>

    <span id='required'><b><font color='red'>* Required</font></b></span>
-->
    <br>
    <div id="postlinks">
      <!-- javascript-generated formstuff here -->
    </div>
    
    <span id="submitLinks"><input type="submit" value="Submit" id="submit"></span>
  </form>
 <!-- <span id="addLink"><a href="javascript: addLink();">New entry field</a></span>  <!-- CSS to absolute near bottom right of addLinks -->
</div>


<script type="text/javascript">
<?php																									// PHP FETCHING AND FEEDING TITLES TO JAVASCRIPT FROM EXTERNAL SITES
	$urls = $_POST[URLs];
	for ($i = 0; $i < count($urls); $i++) {
		$urls[$i] = preg_replace("/>/", "", $urls[$i]);
	}
	$urlsArr = preg_split("/\r\n|\n|\r/", $urls);

	echo "var fetchedTitles = new Array();";
	
	for ($i = 0; $i < count($urlsArr); $i++) {
		try {
			$urlsArr[$i] = preg_replace( "/\r|\n/", "", $urlsArr[$i]);			// sanitizing for line breaks and redundant spaces/indents
			$urlsArr[$i] = preg_replace('/\s+/', ' ', $urlsArr[$i]);
			$content = @file_get_contents($urlsArr[$i]);											// fetchedTitles doesn't appear to exist, or have been initialized properly
			$first_step = explode( "<h1" , $content );
			$second_step = explode( ">" , $first_step[1] );	
			
			if (substr_count($second_step[1], '</') > 0) {
				$fetchedTitles = explode( "<" , $second_step[1] );	
				echo "fetchedTitles.push('".addslashes($fetchedTitles[0])."');\n";
			} else {
				$fetchedTitles = explode( "<" , $second_step[2] );	
				echo "fetchedTitles.push('".addslashes($fetchedTitles[0])."');\n";				
			}
			
						// if string includes < or >, run explodes again to get innertext

		} catch (Exception $e) {
			echo "fetchedTitles.push('Failed to fetch title.');";
		}
	}	
?>

  var postLinks = ' ';														// definitions
	var rawURLs = <?php echo json_encode($_POST[URLs]); ?>;
	var URLarray = rawURLs.split(/\r?\n/);
	var urlInput = document.getElementsByName('url[]');
	
	
	for (var j = 0; j < URLarray.length; j++) {			// for every URL, add input row and hyperlink
		fetchedTitles[j] = fetchedTitles[j].replace("'", "&rsquo;");
		addLink();
		postLinks += "<a href='"+URLarray[j]+"' target='_blank'>Follow Link</a>";
		postLinks += "<input type='text' class='fetchedTitle' onclick='this.select()' value='"+fetchedTitles[j]+"'>";
		postLinks += '<br>';
	}
		document.getElementById('postlinks').innerHTML = postLinks;
	
	
	for (var i = 0; i < URLarray.length; i++) {			// fills each URL input with posted array item
		urlInput[i].value = URLarray[i];
	}
	
	for (var i = 0; i < urlInput.length; i++) {			// autofills common authors
			searchURLs(urlInput[i]);
	}
	
	

	
	function searchURLs(url) {				// convert to switch cases
			var nextEl = url.nextElementSibling; 
	
			if (url.value.search('kingworldnews') > -1) {nextEl.value = "King World News";} 
			if (url.value.search('mishtalk') > -1) { nextEl.value = "Mish";}
			if (url.value.search('ft.com') > -1) { nextEl.value = "Financial Times";}
			if (url.value.search('gata.org') > -1) { nextEl.value = "GATA";}
			if (url.value.search('dailyreckoning') > -1) { nextEl.value = "Daily Reckoning";}
			if (url.value.search('bloomberg.com') > -1) { nextEl.value = "Bloomberg";}
			if (url.value.search('automaticearth.com') > -1) { nextEl.value = "Automatic Earth";}
			if (url.value.search('forbes.com') > -1) { nextEl.value = "Forbes";}
			if (url.value.search('oilprice.com') > -1) { nextEl.value = "Oil Price";}		
			if (url.value.search('cnbc.com') > -1) { nextEl.value = "CNBC";}
			if (url.value.search('wallstreetonparade') > -1) { nextEl.value = "Wall St. On Parade";}
			if (url.value.search('talkmarkets') > -1) { nextEl.value = "Talk Markets";}
			if (url.value.search('yahoo.com') > -1) { nextEl.value = "Yahoo!";}
			if (url.value.search('wolfstreet.com') > -1) { nextEl.value = "Wolf Street";}
			if (url.value.search('thedailygold') > -1) { nextEl.value = "Daily Gold";}
			if (url.value.search('goldcore.com') > -1) { nextEl.value = "GoldCore";	}
			if (url.value.search('thestreet.com') > -1) { nextEl.value = "The Street";}
			if (url.value.search('investors.com') > -1) { nextEl.value = "Investors";}
			if (url.value.search('safehaven.com') > -1) { nextEl.value = "Safe Haven";}
			if (url.value.search('schiffgold.com') > -1) { nextEl.value = "Schiff Gold";}
			if (url.value.search('srsroccoreport.com') > -1) { nextEl.value = "SRSrocco Report";}
			if (url.value.search('321gold.com') > -1) { nextEl.value = "321Gold";}
			if (url.value.search('birchgold.com') > -1) { nextEl.value = "Birch Gold";}
			if (url.value.search('presstv.com') > -1) { nextEl.value = "Press TV";}
			if (url.value.search('valuewalk') > -1) { nextEl.value = "ValueWalk";}
			if (url.value.search('businessinsider.com') > -1) { nextEl.value = "Business Insider";}
			if (url.value.search('ibtimes.com') > -1) { nextEl.value = "IB Times";}
			if (url.value.search('techdirt.com') > -1) { nextEl.value = "Tech Dirt";}
			if (url.value.search('profitconfidential.com') > -1) { nextEl.value = "Profit Confidential";}
			if (url.value.search('doctorhousingbubble.com') > -1) { nextEl.value = "Dr. Housing Bubble";}
			if (url.value.search('telegraph.co.uk') > -1) { nextEl.value = "Telegraph";}
			if (url.value.search('zerohedge.com') > -1) { nextEl.value = "Zero Hedge";}
			if (url.value.search('moodys.com') > -1) { nextEl.value = "Moody's";}
			if (url.value.search('creditbubblebulletin.com') > -1) { nextEl.value = "Credit Bubble Bulletin";}
			if (url.value.search('seattletimes.com') > -1) { nextEl.value = "Seattle Times";}
			if (url.value.search('nasdaq.com') > -1) { nextEl.value = "NASDAQ";}
			if (url.value.search('project-syndicate.org') > -1) { nextEl.value = "Project Syndicate";}
			if (url.value.search('reuters.com') > -1) {nextEl.value = "Reuters";} 
			if (url.value.search('markstcyr.com') > -1) {nextEl.value = "Mark St. Cyr";} 
			if (url.value.search('nytimes') > -1) {nextEl.value = "New York Times";} 

			if (url.value.length == 0) {nextEl.value = "";}
	}
	

	
  function addLink() {
    postLinks += '<input type="text" name="url[]" placeholder="URL">';
    postLinks += '<input type="text" name="author[]" placeholder="Author">';
    postLinks += '<input type="text" name="title[]" placeholder="Title">';
  }
	
/*
  function showhide() {														  // CHANGE SO INNER COMMANDS AFFECT THE INPUT ROWS
		categoryDiv = document.getElementById(categories[i].value);
		for (var i = 0; i < categories.length; i++) {
			if (categories[i].checked) {
				categoryDiv.setAttribute("style", " ");
			} else {
				categoryDiv.setAttribute("style", "display: none;");
			}
		}
  }
*/
	//  var category = document.getElementById('category');
	//  var required = document.getElementById('required');
/* category.onchange = function() {
    if (category.options[category.selectedIndex].value === 'unset') {
      document.getElementById('submit').disabled = true;
      required.setAttribute('style', '');
    } else {
      document.getElementById('submit').disabled = false;
      required.setAttribute('style', 'display: none;');
    }
  }
*/
 

  /*
  var categories = document.getElementsByName('category');

  for (var i = 0; i < categories.length; i++) {
		postLinks += '<div id="'+category[i].value+"><h3>' + categories[i].value + '</h3><br>';
		for (var j = 0; j < 10; j++) {
			addLink();
		}
	postLinks += '</div>';
  }
 
  for (var i = 0; i < categories.length; i++) {
	categories[i].addEventListener("onchange", function(){
		showhide();
	});
  }
 */
</script>