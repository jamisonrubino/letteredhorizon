    // NAVIGATION "SELECTED" AND #MAIN PHP INCLUDES
var nav = document.querySelector("nav"),
  navLink = nav.querySelectorAll("a"),
  main =  document.getElementById('main'),
  page

var select = function() {                   // removes "selected" from all nav links, re-adds to clicked link
  for (var i = 0; i < navLink.length; i++) {
    navLink[i].classList.remove("selected")
  }
  this.classList.add("selected")
}

for (var i = 0; i < navLink.length; i++) {
  navLink[i].addEventListener('click', select)
}
