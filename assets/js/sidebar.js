var catText = document.getElementsByClassName("title-cat")[0].textContent;
var linkSidebar = document.querySelectorAll(".link-sidebar");
var sidebarMenu = document.getElementsByClassName("sidebar")[0];
var iconSidebar = document.getElementsByClassName("fas")[0];
var menu = document.getElementsByClassName("menu")[0];
var i = 0;

function dataMenuActive() {
	if (catText.includes("Admin")) {
		for (let j = 0; j < 2; j++) {
			linkSidebar[j].style.display = "block";
		}
		menu.style.display = "block";
		linkSidebar[0].innerHTML = "User";
		linkSidebar[0].href = "http://localhost/beacukai/akun";
		linkSidebar[1].innerHTML = "Logout";
		linkSidebar[1].href = "http://localhost/beacukai/home/logout";
	} else {
		for (let j = 0; j < linkSidebar.length; j++) {
			linkSidebar[j].style.display = "block";
		}
		menu.style.display = "block";
		linkSidebar[0].innerHTML = "Surat Masuk";
		linkSidebar[0].href = "http://localhost/beacukai/akun/index/suratmasuk";
		linkSidebar[1].innerHTML = "Surat Keluar";
		linkSidebar[1].href = "http://localhost/beacukai/akun/index/suratkeluar";
		linkSidebar[2].innerHTML = "ND Masuk";
		linkSidebar[2].href = "http://localhost/beacukai/akun/index/ndmasuk";
		linkSidebar[3].innerHTML = "ND Keluar";
		linkSidebar[3].href = "http://localhost/beacukai/akun/index/ndkeluar";
		linkSidebar[4].innerHTML = "Logout";
		linkSidebar[4].href = "http://localhost/beacukai/home/logout";
	}
}

function dataMenuNonactive() {
	if (catText.includes("Admin")) {
		for (let j = 0; j < 2; j++) {
			linkSidebar[j].style.display = "none";
		}
		menu.style.display = "none";
	} else {
		for (let j = 0; j < linkSidebar.length; j++) {
			linkSidebar[j].style.display = "none";
		}
		menu.style.display = "none";
	}
}

function sidebar() {
	if (i == 0) {
		// sidebarMenu.style.display = "block";
		sidebarMenu.style.width = "200px";
		iconSidebar.className = "fas fa-times";
		dataMenuActive();
		i++;
	} else {
		// sidebarMenu.style.display = "none";
		sidebarMenu.style.width = "0";
		iconSidebar.className = "fas fa-bars";
		dataMenuNonactive();
		i = 0;
	}
}
