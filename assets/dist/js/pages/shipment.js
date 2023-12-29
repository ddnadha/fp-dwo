$(function () {
	$("#data_shipment").DataTable();

	$.ajax({
		type: "POST",
		url: base_url+ "/Shipment/topShipment",
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
			var indiLabel = [];
			var indiValue = [];

			$("#chartPsales").remove(); 
			$("#chartku").append('<div id="chartPsales"></div>');

			response.product.forEach((t) => {
				indiLabel.push(t.name);
				indiValue.push(parseInt(t.total));
			});
			Highcharts.chart("chartPsales", {
				chart: {
					type: "column",
				},
				title: {
					text: "Chart",
				},

				xAxis: {
					categories: indiLabel,
					crosshair: true,
				},
				yAxis: {
					min: 0,
					title: {
						text: "Total Unit Sales",
					},
				},
				tooltip: {
					headerFormat:
						'<span style="font-size:10px">{point.key}</span><table>',
					pointFormat:
						'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y} Unit</b></td></tr>',
					footerFormat: "</table>",
					shared: true,
					useHTML: true,
				},
				plotOptions: {
					column: {
						pointPadding: 0.3,
						borderWidth: 0,
					},
				},
				series: [
					{
						name: "Total Unit Sales",
						data: indiValue,
					},
				],
			});
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
		},
	});

	$("#gen").click(function () {
		$.ajax({
			type: "POST",
			url: base_url+ "/Shipment/topShipment",
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
				var indiLabel = [];
				var indiValue = [];

				$("#chartPsales").remove();
				$("#chartku").append('<div id="chartPsales"></div>');

				response.product.forEach((t) => {
					indiLabel.push(t.name);
					indiValue.push(parseInt(t.total));
				});

				Highcharts.chart("chartPsales", {
					chart: {
						type: "column",
					},
					title: {
						text: "Chart",
					},

					xAxis: {
						categories: indiLabel,
						crosshair: true,
					},
					yAxis: {
						min: 0,
						title: {
							text: "Total Unit Sales",
						},
					},
					tooltip: {
						headerFormat:
							'<span style="font-size:10px">{point.key}</span><table>',
						pointFormat:
							'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
							'<td style="padding:0"><b>{point.y} Unit</b></td></tr>',
						footerFormat: "</table>",
						shared: true,
						useHTML: true,
					},
					plotOptions: {
						column: {
							pointPadding: 0.3,
							borderWidth: 0,
						},
					},
					series: [
						{
							name: "Total Unit Sales",
							data: indiValue,
						},
					],
				});
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			},
		});
	});
});