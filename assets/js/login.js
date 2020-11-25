$(".message a").click(function () {
	$("form").animate({ height: "toggle", opacity: "toggle" }, "slow");
});
var flashData = document.getElementById("flash").getAttribute("data-flashData");

function iconAksi(data) {
	var patt = [/salah/i, /tidak/i]; //pattern regex
	var resultIcon, result;
	for (let i = 0; i < patt.length; i++) {
		result = data.match(patt[i]); //pencocokkan
		if (result != "") {
			break;
		}
	}
	if (result == "salah") {
		resultIcon = "error";
	} else {
		resultIcon = "info";
	}
	return resultIcon;
}

if (flashData) {
	Swal.fire({
		icon: iconAksi(flashData),
		title: flashData,
		confirmButtonText: `Ok`,
	});
}
