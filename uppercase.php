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
	a.ogpage {
		color: #5252ee;
		font-size: 1.5em;
		text-decoration: none;
	}
</style>
<?php
	$title = $_POST['title'];
	$title = explode(" ", $title);
	$checkedWords = $_POST['uppercase'];
	if (isset($_POST['uppercase'])) {
		foreach ($checkedWords as $word) {
			$title[$word] = ucfirst($title[$word]);
		}
	}
?>
<textarea cols=50 rows=2></textarea>
<br><br>
<a href="title input form.php" class="ogpage">New title</a>
<script type="text/javascript">
	var textarea = document.getElementsByTagName('textarea');
	var title = <?php echo json_encode(implode(" ", $title)); ?>;
//	title = title.replace(/(^|[^\\])"/g, '$1\\"');
//	title = title.replace(/\\/g, '');
	textarea[0].innerHTML = title;
</script>