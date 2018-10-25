<?php
  session_start();
  $querytype = "";
  if(isset($_SESSION['username'])) {
    if(isset($_GET['id'])) {
      $id = $_GET['id'];
      include "php/sql.php";
      $result = $db->query("SELECT * FROM posts WHERE id = ".$id.";");
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $querytype = "?querytype=1";
    }
?>

<div id="userpost">
  <div id="alert" style="display:none;"></div>
  <form action="php/post_handler.php<?php echo $querytype; ?>" method="post" id="post_form">
    <input type="text" name="title" id="title" placeholder="Title" value="<?php echo $row[title]; ?>">
    <textarea name="postbody" id="postbody" cols="80" rows="20"><?php echo $row[post]; ?></textarea>
    <br>
    <select class="post-select" name="tag" id="tag">
      <option value="health">Health</option>
      <option value="money">Money</option>
      <option value="earth">Earth</option>
      <option value="society">Society</option>
      <option value="tech">Tech</option>
    </select>
    <input type="hidden" name="post-id">
    <input type="submit" name="submit" value="Post">
    <?php if(isset($_GET['id'])) { ?><button type="button" class="delete-button">Delete</button><?php } ?>
  </form>

</div>

<script type="text/javascript">
  <?php if(isset($_GET['id'])) { ?>
    $('.post-select option[value="<?php echo $row[tags]; ?>"]').prop('selected', true)
    $('input[name="post-id"]').val(<?php echo $_GET['id']; ?>)
  <?php } ?>
</script>


<?php
  }
?>

<script type="text/javascript">
	$('input[type=submit]').click(e=>{
		e.preventDefault()
		console.log("preventDefault()")
		var formData = {
			title: $('#title').val(),
			postbody: $('#postbody').val(),
			tag: $('#tag').val()
		},
		postAction = 'php/post_handler.php<?php echo $querytype; ?>',
		idVal = $('input[name=post-id]').val()
		
		idVal.length > 0 ? formData.id = idVal : null
	
		if (formData.title.length > 0 && formData.postbody.length > 0) {
			console.log(formData, postAction)
			$.post(postAction, formData, function(response) {
				console.log(response)
				if (response.indexOf("Success") > -1) {    
					if (response.indexOf("INSERT") > -1) {
						$('#alert').text("Success! Your post was created.").removeClass('failure').addClass('success').show(400)
					} else if (response.indexOf("UPDATE") > -1) {
						$('#alert').text("Success! Your post was updated.").removeClass('failure').addClass('success').show(400)
					}
					setTimeout(()=>window.location.href="/", 2500)
				} else {
					$('#alert').text("Something went wrong. :c").removeClass('success').addClass('failure').show(400)
				}
			})
			<?php if(count($querytype) == 0) { ?>
			$('#title').val("")
			$('#postbody').text("")
			<?php } ?>
		} else {
			$('#alert').text("Don't forget the content!").removeClass('success').addClass('failure').show(400)
		}
	})
	
	$('button.delete-button').click(e=>{
		e.preventDefault()
		if (confirm("Are you sure you want to delete this post?")) {
			
			var formData = {
				id: $('input[name=post-id]').val(),
				del: true
			}
			console.log(formData)
			
			$.post("php/post_handler.php", formData, function(response) {
				if (response.indexOf("Success") > -1) {
					$('#alert').text("Success! Your post is gone.").removeClass('failure').addClass('success').show(400)
					setTimeout(()=>window.location.href="/", 2500)
				} else {
					$('#alert').text("Something went wrong. :c Your post is eternal.").removeClass('success').addClass('failure').show(400)
				}
			})
		}		
	})
	
</script>
