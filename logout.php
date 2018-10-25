<?php
	session_start();
  if(isset($_SESSION['username'])) {
    session_destroy();
    echo "You successfully logged out.";
  }
?>

<script type="text/javascript">
  (function(){
		setTimeout(()=>window.location.href = "/", 2500)
	})()
</script>