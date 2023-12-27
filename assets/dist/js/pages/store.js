$(async function () {
	$("#data_store").DataTable();

	await $.ajax({
		type: "POST",
		url: "http://localhost/dwo23/Store/topStore",
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
			url: "http://localhost/dwo23/Store/topStore",
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

	await $.ajax({
		type: "POST",
		url: "http://localhost/dwo23/Store/regionSales",
		dataType: "json",
		beforeSend: function (e) {
			if (e && e.overrideMimeType) {
				e.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		success: function (response) {
			var a = [];
			var b = [];

			var indiLabel = [];
			var indiValue = [];

			response.forEach((element) => {
				var c = {};
				c.name = element.group.replace(/\s/g, "");
				c.y = element.total;
				c.custom = element.jumlah;

				c.drilldown = element.group.replace(/\s/g, "");
				a.push(c);

				var d = {};
				d.name = element.group.replace(/\s/g, "");
				d.id = element.group.replace(/\s/g, "");
				d.data = element.drill;
				b.push(d);
			});
			$("#chartStoreRegion").remove();
			$("#chartStoreReg").append('<div id="chartStoreRegion"></div>');
			Highcharts.chart("chartStoreRegion", {
				chart: {
					type: "pie",
				},
				title: {
					text: "Product Category Chart",
				},

				accessibility: {
					announceNewData: {
						enabled: true,
					},
					point: {
						valueSuffix: "%",
					},
				},

				plotOptions: {
					series: {
						dataLabels: {
							enabled: true,
							format: "{point.name}: {point.y:.1f}%",
						},
					},
				},

				tooltip: {
					useHTML: true,

					formatter: function () {
						var points = this.point;
						console.log(points);
						return (
							`<span style="color:{series.color}"> <b>` +
							points.name +
							` </b></span><br/>
								<span style="color:{series.color}">Total Product : <b>` +
							points.custom +
							`</b></span><br/>`
						);
					},
				},

				series: [
					{
						name: "Group",
						colorByPoint: true,
						data: a,
					},
				],
				drilldown: {
					series: b,
				},
			});
			console.log(a);
			console.log(b);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// Ketika ada error
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
		},
	});
});