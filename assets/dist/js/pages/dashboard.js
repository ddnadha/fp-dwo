$(async function () {
	const formatter = new Intl.NumberFormat("en-US", {
		style: "currency",
		currency: "USD",
	});

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/dwo23/Dashboard/fakta", // Isi dengan url/path file php yang dituju
		data: {
			tahun: $("#tahun").val(),
			bulan: $("#bulan").val()
		},
		dataType: "json",
		beforeSend: function (e) {
			if (e && e.overrideMimeType) {
				e.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		success: function (response) {
			// $("#loading").hide();
			console.log(response);
			var sales = response.sales;
			var po = response.po;

			$("#srevenue").text(formatter.format(sales));
			$("#pexpanses").text(formatter.format(po));
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// Ketika ada error
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
		},
	});

	$("#gen").click(function () {
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "http://localhost/dwo23/Dashboard/fakta", // Isi dengan url/path file php yang dituju
			data: {
				tahun: $("#tahun").val(),
				bulan: $("#bulan").val()
			},
			dataType: "json",
			beforeSend: function (e) {
				if (e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function (response) {
				// $("#loading").hide();
				console.log(response);
				var sales = response.sales;
				var po = response.po;

				$("#srevenue").text(formatter.format(sales));
				$("#pexpanses").text(formatter.format(po));
			},
			error: function (xhr, ajaxOptions, thrownError) {
				// Ketika ada error
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
			},
		});
	});
});
