<link rel="stylesheet" type="text/css" href="links.css">

<div class="links">
  
<?php
  include "sql.php";
  
  $category = array(
    'Best of the Web',
    'The Economy',
    'Precious Metals',
    'Inflation, Deflation, Currency War, Cryptocurrencies',
    'Real Estate Bubble',
    'DollarCollapse Podcasts',
    'Ron Paul, Rand Paul, Elizabeth Warren, Bernie Sanders',
    'Offshore Investing',
    'Clean Tech',
    'Art of the Collapse',
    'War',
    'Self-sufficiency, Food Security, Survival',
    'CyberWar, CyberTerrorism, CyberCrime',
    'Off-Topic But Brilliant/Challenging/Infuriating'
  );
  
    
    $outputCode = ' ';
  
      foreach ($category as $categoryItem) {      // for each category, output 15 most recent
        $result = $db->query('SELECT * FROM links WHERE category = "'.$categoryItem.'" ORDER BY id DESC LIMIT 15');
        $outputCode .= "<h2>".$categoryItem."</h2>";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

          if ($row['date'] == (date('M j') || date(('M j'), strtotime('tomorrow')))) {
            $outputCode .= "<div class='link today'>";
          } else {
            $outputCode .= "<div class='link'>";
          }

          $outputCode .= "<div class='date'>" .$row['date']. "</div>";
          $outputCode .= "<div class='body'>";
          $outputCode .= "<a href='" .$row['url']. "'>" .$row['title']. "</a>";
          $outputCode .= " – " .$row['author']. "<br>";
          $outputCode .= "</div></div>";
      }
    }

  echo "<div id='prevnext'>";
//  echo "<a href='javascript:prevPage()' class='prevnext'>PREV</a>"." ";
//  echo "<a href='javascript:nextPage()' class='prevnext'>NEXT</a>";
  echo "</div>";

?>
  
<script type="text/javascript">
								// PROBLEMS:
									// ALL LINKS SHOW 'TODAY' CLASS
									// ALL BUT FIRST RETAIN 'NODISPLAY' CLASS
										// REMOVED PAGINATION
									// ALL NEED TO BE CLEARED FROM DB SO DATES MATCH NEW FORMAT
									// PREVNEXT SHOULD BE ABOVE TEXTAREA
										// REMOVE PREV/NEXT WITH PAGINATION
									// FIX SHOWSOME() TO TARGET 20 OF EACH CATEGORY, NOT 20 TOTAL
										// REMOVED PAGINATION


  var linksHTML = document.createTextNode(<?php echo json_encode($outputCode); ?>);       // PULLS ABOVE SQL QUERY INTO JS
  var prevNextDiv = document.getElementById('prevnext');
  var linksDiv = document.getElementsByClassName('links');
  
  var linksText = document.createElement('textarea');
    linksText.setAttribute('cols', 80);
    linksText.setAttribute('rows', 30);
    linksText.value = linksHTML.textContent.slice(1, (linksHTML.length));       // LATER: MODIFY PHP OUTPUT TO AVOID SLICING
	linksDiv[0].insertBefore(linksText,prevNextDiv);
	
	var richLinksDiv = document.createElement('div');
	richLinksDiv.innerHTML = linksHTML.textContent;
	linksDiv[0].insertBefore(richLinksDiv,linksText);
/*
  

  var linksHTMLNode = document.createElement('div');
  linksHTMLNode.setAttribute('id', 'linksHTMLNode');
  linksHTMLNode.innerText = linksHTML.textContent.slice(1, linksHTML.length - 1);
  document.insertBefore(linksHTMLNode, prevnextDiv);    // PLACE LINKSHTML BEFORE PREVNEXT
  
  */
  
  
  /*
  var link = document.getElementsByClassName('link');
  var prevnext = document.getElementsByClassName('prevnext');
 var page = 0;
  
  hideAll();
  showSome();
  disablePrevNext();
  
 
  function hideAll() {
    for (var i = 0; i < link.length; i++) {
      link[i].classList.add('nodisplay');
    }
  }
  
  function showSome() {
    if (link.length > page) {
      for (var i = 0; i < 20; i++) {
		if (link[page]) {
          link[page].classList.remove('nodisplay');
		}
		page++;
      }
    }
  }

  function nextPage() {
    if(page < link.length) {
	  hideAll();
	  showSome();
      disablePrevNext();
	}
  }
  
  function prevPage() {
    if (page > 19) {
      page -= 40;
      hideAll();
      showSome();
      disablePrevNext();
    }
  }
  
  function disablePrevNext() {
    if (link.length <= page) {
      prevnext[1].classList.add('disabled');
    } else {
      prevnext[1].classList.remove('disabled');
    }
    
    if (page <= 20) {
      prevnext[0].classList.add('disabled');
    } else {
      prevnext[0].classList.remove('disabled');
    }
  }
  
  */
</script>
</div>