<style type="text/css">
	input[type="text"].title {
		width: 500px;
	}
	div.divwrap {
		display: inline-block;
		float: left;
		margin: 0 6px;
	}
	div.worddiv, div.checkdiv {
		display: block;
		text-align: center;
		padding: 2px;
	}
</style>

<?php
	$title = $_POST['title'];
	$title = strtolower($title);
	$wordsArray = explode(" ", $title);
	$wordsArray[0] = ucfirst($wordsArray[0]);
?>
<form action="uppercase.php" method="post">
<!--	<input type="text" value="<?php //echo addslashes(implode(" ", $wordsArray)); ?>" name='title' style="height: 0px; color: white; border-color: white; border-style: none;"><br> -->
	<input type="submit" value="Submit" id="submit">
</form>
<script type="text/javascript">
	var form = document.getElementsByTagName('form');
	var submit = document.getElementById("submit");
	var hiddeninput = document.createElement('input');
	hiddeninput.setAttribute("type", "text");
	hiddeninput.setAttribute("name", "title");
	hiddeninput.setAttribute("style", "height: 0px; color: white; border-color: white; border-style: none;");
	hiddeninput.setAttribute("value", "<?php echo addslashes(implode(" ", $wordsArray)); ?>");
	var visibleinput = document.getElementsByTagName('input');
	form[0].insertBefore(hiddeninput, visibleinput[0]);
</script>
<?php	for ($i = 0; $i < count($wordsArray); $i++) {
?>		
			<script type="text/javascript">
				var titleWord = <?php echo json_encode($wordsArray[$i]); ?>;
				var divWrap = document.createElement('div');
					divWrap.classList.add('divwrap');
				var wordDiv = document.createElement('div');
					wordDiv.classList.add('worddiv');
				var checkDiv = document.createElement('div');
					checkDiv.classList.add('checkdiv');
				var wordCheck = document.createElement('input');
					wordCheck.setAttribute("type", "checkbox");
					wordCheck.setAttribute("name", "uppercase[]");
					wordCheck.setAttribute("value", <?php echo json_encode($i); ?>);

				wordDiv.innerHTML = titleWord;
				checkDiv.appendChild(wordCheck);
				divWrap.appendChild(wordDiv);
				divWrap.appendChild(checkDiv);
				form[0].insertBefore(divWrap, submit);
			</script>
<?php
	}
?>