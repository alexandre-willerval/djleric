window.onload = function() {
	var params = document.querySelector("#params");
	params.img = document.querySelector("#params img");
	params.onmouseover = function() {
		this.img.src = this.img.src.replace(".png", "_hover.png");
	}
	params.onmouseout = function() {
		this.img.src = this.img.src.replace("_hover.png", ".png");
	}

	var links = document.querySelectorAll("a.icon");
	var images = document.querySelectorAll("a.icon img");
	var popups = document.querySelectorAll("div.popup");
	
	for(var i=0; i<links.length; i++) {
		popups[i].is_displayed = function() {
			return this.style.display=="block";
		}
		popups[i].show = function() {
			this.style.display = "block";
		}
		popups[i].hide = function() {
			this.style.display = "none";
		}
		
		links[i].img = images[i];
		links[i].popup = popups[i];
		links[i].onclick = function() {
			if(this.popup.is_displayed()) {
				this.popup.hide();
			} else {
				for(var j=0; j<links.length; j++) {
					popups[j].hide();
				}
				this.popup.show();
			}
		}
		links[i].onmouseover = function() {
			this.img.src = this.img.src.replace(".png", "_hover.png");
		}
		links[i].onmouseout = function() {
			this.img.src = this.img.src.replace("_hover.png", ".png");
		}
	}
}