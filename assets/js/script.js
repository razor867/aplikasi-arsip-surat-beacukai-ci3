var btnAction = document.getElementsByClassName("btn-primary")[0];
var modalTitle = document.getElementsByClassName("modal-title")[0];
var judulTabel = document.getElementsByClassName("title-table")[0];
var info = document.getElementsByClassName("info")[0];
var asalTujuan = document.getElementsByClassName("asal-tujuan");
var form = document.getElementById("form-modal");
var tableData;
var flashData = document.getElementById("flash").getAttribute("data-flashData");

if (judulTabel.textContent == "Daftar Pengguna") {
	tableData = "login";
} else {
	info.style.display = "none";
	if (judulTabel.textContent == "Daftar Surat Masuk") {
		tableData = "surat_masuk";
		asalTujuan[0].innerHTML = "Asal";
		asalTujuan[1].innerHTML = "Asal";
	} else if (judulTabel.textContent == "Daftar Surat Keluar") {
		tableData = "surat_keluar";
		asalTujuan[0].innerHTML = "Tujuan";
		asalTujuan[1].innerHTML = "Tujuan";
	} else if (judulTabel.textContent == "Daftar ND Masuk") {
		tableData = "nd_masuk";
		asalTujuan[0].innerHTML = "Asal";
		asalTujuan[1].innerHTML = "Asal";
	} else {
		tableData = "nd_keluar";
		asalTujuan[0].innerHTML = "Tujuan";
		asalTujuan[1].innerHTML = "Tujuan";
	}
}

function tambah() {
	modalTitle.innerHTML = "Tambah Data";
	form.action = "http://localhost/beacukai/akun/tambah/" + tableData;
	btnAction.innerHTML = "Simpan";
	if (!tableData == "login") {
		info.style.display = "none";
	}

	if (tableData == "login") {
		$("#username").val("");
		$("#password").val("");
		$("#departemen").val("");
	} else {
		$("#nosurat").val("");
		$("#tanggal").val("");
		$("#agenda").val("");
		$("#asaltujuan").val("");
		$("#perihal").val("");
		$("#filesurat").prop("required", true);
		$("#info").val("");
	}
}

function edit(idData) {
	modalTitle.innerHTML = "Edit Data";
	form.action =
		"http://localhost/beacukai/akun/edit/" + idData + "/" + tableData;
	btnAction.innerHTML = "Rubah";

	$.ajax({
		url: "http://localhost/beacukai/akun/getData",
		data: {
			id: idData,
			table: tableData,
		},
		method: "post",
		dataType: "json",
		success: function (data) {
			if (tableData == "login") {
				$("#username").val(data[0].user);
				$("#password").val(data[0].pass);
				$("#departemen").val(data[0].cat);
			} else {
				info.style.display = "block";
				$("#nosurat").val(data[0].nomor_srt);
				$("#tanggal").val(data[0].tanggal);
				$("#agenda").val(data[0].agenda);
				if (tableData == "surat_masuk" || tableData == "nd_masuk") {
					$("#asaltujuan").val(data[0].asal);
				} else {
					$("#asaltujuan").val(data[0].tujuan);
				}
				$("#perihal").val(data[0].perihal);
				$("#info").val(data[0].nama_file_srt);
				$("#filesurat").removeAttr("required");
			}
		},
	});
	// window.onload = () => {
	// 	const myInputPass = document.getElementById("password");
	// 	myInputPass.onpaste = (e) => e.preventDefault();
	// };
}

function hapus(idData) {
	// var a = confirm("Yakin hapus data ini?");
	// if (a == true) {
	// 	window.location.href =
	// 		"http://localhost/beacukai/akun/hapus/" + idData + "/" + tableData;
	// }
	Swal.fire({
		title: "Yakin hapus data ini?",
		text: "kamu akan kehilangan data ini di server!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href =
				"http://localhost/beacukai/akun/hapus/" + idData + "/" + tableData;
		}
	});
}

if (flashData) {
	Swal.fire({
		icon: "success",
		title: flashData,
		confirmButtonText: `Ok`,
	});
}
