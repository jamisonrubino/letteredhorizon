<?php
session_start();
?>

<head>
<link rel="stylesheet" type="text/css" href="css/main.css">
<!-- <link href='https://fonts.googleapis.com/css?family=Cardo:400,400italic,700' rel='stylesheet' type='text/css'> -->
<link href="https://fonts.googleapis.com/css?family=Jaldi" rel="stylesheet">
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<title>Lettered Horizon | On Tomorrow's Fields</title>
<!-- ADD TAGS, TITLE, FAVICON -->

</head>
<body>
  <div id="doc">         <!-- wraps all document contents, potential background layer -->
    <div id="body">         <!-- wraps all body contents, keeps border/width of header/main/footer -->
      <header id="header" class="">
			<div id="banner">
				<a href="/" title="Lettered Horizon Home">
				</a>
<!--        <h1>Lettered Horizon</h1> -->
<!--				<div id="tagline"><span>News and musings on tomorrow's fields</span></div> -->
				<!-- rework later -->
        </div>
      </header>
		<div id="navbg">
      <nav>
        <ul>
          <li><a href="javascript: void(0)">Home</a></li>    <!-- FIND WAY TO MAKE #MAIN CYCLE BETWEEN PHP INCLUDES BY NAV CLICKS -->
          <li><a href="javascript: void(0)">Health</a></li>
          <li><a href="javascript: void(0)">Money</a></li>
          <li><a href="javascript: void(0)">Earth</a></li>
          <li><a href="javascript: void(0)">Society</a></li>
					<li><a href="javascript: void(0)">Tech</a></li>


          <?php if(isset($_SESSION['username'])) { ?>
            <li><a href="javascript: void(0)" class="post">Post</a></li>
            <li><a href="javascript: void(0)">Logout</a></li>
          <?php } else { ?>
            <li><a href="javascript: void(0)">Register</a></li>
            <li><a href="javascript: void(0)">Login</a></li>
          <?php } ?>


        </ul>
      </nav>
		</div>
      <div id="main">
      </div>

      <div id="ads">
      </div>

      <footer>
        © LetteredHorizon.com <?php echo date(Y); ?>
      </footer>
    </div>
  </div>

  <!-- <script type="text/javascript" src="js/posts.js"></script> -->
  <script type="text/javascript" src="js/nav.js"></script>
  <script type="text/javascript">
    function updateUrl(obj, title, uri) {
      window.history.pushState(obj, title, uri)
    }
	
	function updateNav(currPage) {
		$('nav ul li a.selected').removeClass('selected')
		$("nav ul li a:contains('"+currPage+"')").addClass('selected')
	}

	function editLinks() {
      clearTimeout(editLinksTimeout)
      editLinksTimeout = setTimeout(function(){
        $('.edit-link').each(function(){
          $(this).on("click", function(){
			let query = "?id=" + $(this).data('post-id')
			page = "Post"
			update = {
				obj: {location: page.toLowerCase()},
				title: "LetteredHorizon - Post Editor",
				page: page,
				internal: true
			}
			loadPage(update, page, query).then(updateNav(page))
          })
        })
        console.log("editLinks ran!")
      }, 1000)
	}

    const loadPage = async (update, pageLoaded, query = "") => {
      const lP = () => {
          $("#main").load(pageLoaded.toLowerCase()+".php"+query, ()=>updateUrl(update.obj, update.title, update.page))
          console.log("loadPage ran!")
      }
      return await lP()
    }

// VARIABLE DECLARATIONS -------------------------------------------------------------

	var url = window.location.href,
		uri = url.slice(url.indexOf(".com")+5),
		page = uri.length > 0 ? uri[0].toUpperCase() + uri.slice(1) : "Home",
		pageData = {},
		header = $("header")[0],
		update = {
		  obj: {location: page.toLowerCase()},
		  title: "LetteredHorizon - " + page,
		  page: page
		},
		editLinksTimeout

		
	$(document).ready(function(){
		if (!update.internal) {
		  loadPage(update, page).then(editLinks())
		  updateNav(page)
		}

		$('nav ul li a').click(function() {
		  if (page == "Post" && ($('#title').val().length > 0 || $('#postbody').val().length > 0) && !confirm("You may lose your unsaved work. Continue?"))
			return
		  page = this.innerText
		  update = {
			obj: {location: page.toLowerCase()},
			title: "LetteredHorizon - " + page,
			page: page,
			internal: true
		  }
		  loadPage(update, page).then(editLinks())
		})

		window.onscroll = function() {
			if (document.body.scrollTop > 150) {
			if (!header.className.includes("scrolled"))
					header.classList.add("scrolled")
			} else {
				if (header.className.includes("scrolled"))
					header.classList.remove("scrolled")
			}
		}

	})
    // includes "posts.php", targets <div id="main">, outputs post list with page buttons below: [PREV] [NEXT]
  </script>
</body>

<!--
CREATE FILES: NAV.PHP (constructs nav, gets "page" value, adds "selected' class), POSTS.PHP, MAIN.PHP () MAIN.CSS, SQL.PHP, MODIFYPOST.PHP (CREATES AND EDITS), REGISTER.PHP (FORM PAGE, PASSES TO:), REGISTERUSER.PHP


-->
