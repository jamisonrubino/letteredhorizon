var posts = 0;
var entries = document.getElementsByClassName("entry");
var postbody = document.getElementsByClassName("postbody");
var prev = document.getElementById("prev");
var next = document.getElementById("next");
hideposts();
showposts();
buttons();

function showposts() {
  for(var i = 0; i < 5; i++) {
    if(posts < entries.length) {
        if (postbody[posts].innerText.length > 500) {
          postbody[posts].innerHTML = postbody[posts].slice(0, 500)+"<span>... </span><a href='javascript: void(0);' onclick='showMore(this);' class='showmore'>show more</a>"+"<span style='display: none;'>"+postbody[posts].slice(500, postbody[posts].length)+"</span>";
          entries[posts].setAttribute("style", "");
        } else {
          entries[posts].setAttribute("style", "");
        }
      }
	console.log(posts);
  posts++;
	}
}


function hideposts() {
  for (var i = 0; i < entries.length; i++) {
    entries[i].setAttribute("style", "display: none;"); 
  }
}

function prevPost() {
  if (posts >= 9) {
    posts -= 10;
    hideposts();
    showposts();
    buttons();
  }
}

function nextPost() {
  if (posts < entries.length) {
    hideposts();
    showposts();
    buttons();
  }
}

// DISABLES AND ENABLES PREV/NEXT BUTTONS APPROPRIATELY
function buttons() {
  if (posts < 9) {
    prev.classList.add('prevnext-disabled');
  } else {
    prev.classList.remove('prevnext-disabled');
  }
  if (posts >= entries.length) {
    next.classList.add('prevnext-disabled');
  } else {
    next.classList.remove('prevnext-disabled');
  }
}

function showMore(link) {
  console.log(link.innerHTML);
  link.nextSibling.setAttribute("style", "");
  link.previousSibling.setAttribute("style", "display: none");
  link.setAttribute("style", "display: none");
}