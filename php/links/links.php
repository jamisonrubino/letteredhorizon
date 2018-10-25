<div id='addLinks'>
  <form action="postlinks.php" method="post">
    
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
	
<!--
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
-->
    <span id='required'><b><font color='red'>* Required</font></b></span>

    <br>
    <div id="postlinks">
      <!-- javascript-generated formstuff here -->
    </div>
    
    <span id="submitLinks"><input type="submit" value="Submit" id="submit"></span>
  </form>
  <span id="addLink"><a href="javascript: addLink();">New entry field</a></span>  <!-- CSS to absolute near bottom right of addLinks -->
</div>

<script type="text/javascript">
  // disable submit button if no
  
  var category = document.getElementById('category');
  var required = document.getElementById('required');
  
  category.onchange = function() {
    if (category.options[category.selectedIndex].value === 'unset') {
      document.getElementById('submit').disabled = true;
      required.setAttribute('style', '');
    } else {
      document.getElementById('submit').disabled = false;
      required.setAttribute('style', 'display: none;');
    }
  }
  
  var postLinks = ' ';
  
  for (var i = 0; i < 10; i++) {
    addLink();
  }
  
  function addLink() {
    postLinks += '<input type="text" name="url[]" placeholder="URL">';
    postLinks += '<input type="text" name="author[]" placeholder="Author">';
    postLinks += '<input type="text" name="title[]" placeholder="Title">';
    postLinks += '<br>';
    
    document.getElementById('postlinks').innerHTML = postLinks;
  }
</script>