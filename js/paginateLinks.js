function paginateLinks(pageName) {
	// ADD POSTBODY TEXT TO POSTBODY PARAGRAPHS
	var pagePost = document.getElementsByClassName(pageName);
	for (var i = 0; i < postnum; i++) {
		pagePost[i].innerHTML = postbodies[i];
	}

	var linksSection = document.getElementsByClassName('links');
	var allLinks = document.getElementsByClassName('link');
	var linksNums = [];
	for (var i = 0; i < (linksSection.length); i++) {
		linksNums[i] = 0;			// GLOBAL VARIABLE LINKSNUMS[] CONTROLS LINKS RANGE DISPLAYED IN EACH SECTION
		var sectionLinksGlobal = linksSection[i].getElementsByClassName('link');
		console.log('pass 1');
		if (sectionLinksGlobal[i]) {
			console.log('pass 2');
			hidelinks(i);
			addLinksPrevNext(i);
			arrows(i);
			showlinks(i);
		}
		console.log("linksSection.length = " + linksSection.length + ", this should run " + linksSection.length-1 + " times -- for loop ran " + i + " times");
	}
;

	//		FOR SOME REASON, FUNCTION STOPS AFTER FIRST SECTION -- CREATELEMENT EXCLUSIVITY?
	function addLinksPrevNext(linksSectionNum) {		// FIRST DEFINITION OF LINKSSECTIONNUM, THE KEY TO LINKSNUMS ARRAY
		console.log("addlinks ran " + linksSectionNum + " times");
		var sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link');
		if (sectionLinks.length > 19) {
			var linksdiv = document.createElement('div');
				linksdiv.classList.add('linksprevnext');
			var prevbutton = document.createElement('a');
				prevbutton.href = "javascript: prevLinks(" + linksSectionNum + ");";
				prevbutton.classList.add('linksprev');
				prevbutton.innerHTML = "<";
			var nextbutton = document.createElement('a');
				nextbutton.href = "javascript: nextLinks(" + linksSectionNum + ");";
				nextbutton.classList.add('linksnext');
				nextbutton.innerHTML = ">";
			linksdiv.appendChild(prevbutton);
			linksdiv.appendChild(nextbutton);
			linksSection[linksSectionNum].appendChild(linksdiv);
		}
	}

	function hidelinks(linksSectionNum) {
//		console.log(linksSectionNum);
		var sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link');
		for (var i = 0; i < sectionLinks.length; i++) {
			sectionLinks[i].setAttribute("style", "display:none;");
		}
	}


	function showlinks(linksSectionNum) {
		var sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link');
		var linksRangeBeginning = linksNums[linksSectionNum];
//		console.log(linksRangeBeginning);
		if (sectionLinks.length > linksRangeBeginning) {
			for (var i = linksRangeBeginning; i < (linksRangeBeginning + 20); i++) {
				if (sectionLinks[i]) {
					sectionLinks[i].setAttribute("style", "");
				}
			}
			linksNums[linksSectionNum] += 20;
//			console.log(linksNums[linksSectionNum]);
		}
	}

	function nextLinks(linksSectionNum) {
		var sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link');
		if (linksNums[linksSectionNum] < sectionLinks.length - 1) {
			hidelinks(linksSectionNum);
			showlinks(linksSectionNum);
		}
		arrows(linksSectionNum);
	}

	function prevLinks(linksSectionNum) {
		if (linksNums[linksSectionNum] < 21) {
			linksNums[linksSectionNum] -= 20;
		} else if (linksNums[linksSectionNum] > 39) {
			linksNums[linksSectionNum] -= 40;
		}
			hidelinks(linksSectionNum);
			showlinks(linksSectionNum);
			arrows(linksSectionNum);
	}

	function arrows(linksSectionNum) {		// DISABLES AND ENABLES LINKS ARROWS
		var sectionLinks = null;
		if (sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link')) {
			console.log('pass 1');
			var prevNextDiv = null;
			for (var i = 0; i < linksSection[linksSectionNum].childNodes.length; i++) {
				if (linksSection[linksSectionNum].childNodes[i].className == "linksprevnext") {
					console.log('pass 2');
					prevNextDiv = linksSection[linksSectionNum].childNodes[i];
					var prevArrow = prevNextDiv.childNodes[0];
					var nextArrow = prevNextDiv.childNodes[1];
					var sectionLinks = linksSection[linksSectionNum].getElementsByClassName('link');
					if (linksNums[linksSectionNum] < 21) {
						prevArrow.classList.add('disabled');
						prevArrow.href = "javascript: void(0);";
						console.log('disable prev');
					}
					if (linksNums[linksSectionNum] < sectionLinks.length + 20) {
						nextArrow.classList.remove('disabled');
						nextArrow.href = "javascript: nextLinks(" + linksSectionNum + ");";
						console.log('enable next');
					}
					if (linksNums[linksSectionNum] > sectionLinks.length) {
						nextArrow.classList.add('disabled');
						nextArrow.href = "javascript: void(0);";
						console.log('disable next');
					}
					if (linksNums[linksSectionNum] > 20) {
						prevArrow.classList.remove('disabled');
						prevArrow.href = "javascript: prevLinks(" + linksSectionNum + ");";
						console.log('enable prev');
					}
					console.log("arrows ran");
				}
			}
		}
	}
}
