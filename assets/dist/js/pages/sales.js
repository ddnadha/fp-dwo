$(async function () {
	$("#data_sales").DataTable();

	const formatter = new Intl.NumberFormat("en-US", {
		style: "currency",
		currency: "USD",
	});

	await $.ajax({
		type: "POST", 
		url: "http://localhost/dwo23/Sales/salesRev", 
		dataType: "json",
		beforeSend: function (e) {
			if (e && e.overrideMimeType) {
				e.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		success: function (response) {
			var a = [];
			var b = [];

			response.forEach((element) => {
				var c = {};
				c.name = element.tahun.replace(/\s/g, "");
				c.y = element.total;
				c.drilldown = element.tahun.replace(/\s/g, "");
				a.push(c);

				var d = {};
				d.name = element.tahun.replace(/\s/g, "");
				d.id = element.tahun.replace(/\s/g, "");
				d.data = element.drill;
				b.push(d);
			});

			$("#chartRev").remove();

			$("#chartku").append('<div id="chartRev"></div>');

			Highcharts.chart("chartRev", {
				chart: {
					type: "column",
				},
				title: {
					text: "Chart",
				},
				accessibility: {
					announceNewData: {
						enabled: true,
					},
				},
				xAxis: {
					type: "category",
				},
				yAxis: {
					title: {
						text: "Sales Revenue",
					},
				},
				legend: {
					enabled: false,
				},
				plotOptions: {
					series: {
						borderWidth: 0,
						dataLabels: {
							enabled: true,
							formatter: function () {
								return formatter.format(this.y);
							},
						},
					},
				},

				tooltip: {
					useHTML: true,

					formatter: function () {
						var points = this.point;
						// console.log(this.y);
						return (
							`<span style="color:{series.color}"> <b>` +
							points.name +
							` </b></span><br/>
								<span style="color:{series.color}">Revenue : <b>` +
							formatter.format(points.y) +
							`</b></span><br/>`
						);
					},
				},

				series: [
					{
						name: "Tahun",
						colorByPoint: true,
						data: a,
					},
				],
				drilldown: {
					breadcrumbs: {
						position: {
							align: "right",
						},
					},
					series: b,
				},
			});
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// Ketika ada error
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
		},
	});

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/dwo23/Sales/salesTrend", // Isi dengan url/path file php yang dituju
		dataType: "json",
		beforeSend: function (e) {
			if (e && e.overrideMimeType) {
				e.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		success: function (response) {
			// $("#loading").hide();
			var a = [];
			var b = [];

			response.forEach((element) => {
				var c = {};
				c.name = element.tahun.replace(/\s/g, "");
				c.y = element.total;
				c.drilldown = element.tahun.replace(/\s/g, "");
				a.push(c);

				var d = {};
				d.name = element.tahun.replace(/\s/g, "");
				d.id = element.tahun.replace(/\s/g, "");
				d.data = element.drill;
				b.push(d);
			});

			$("#chartT").remove(); // this is my <canvas> element

			$("#chartku2").append('<div id="chartT"></div>');

			Highcharts.chart("chartT", {
				chart: {
					type: "line",
				},
				title: {
					text: "Chart",
				},
				accessibility: {
					announceNewData: {
						enabled: true,
					},
				},
				xAxis: {
					type: "category",
				},
				yAxis: {
					title: {
						text: "Total Order",
					},
				},
				legend: {
					enabled: false,
				},
				plotOptions: {
					series: {
						borderWidth: 0,
						dataLabels: {
							enabled: true,
							formatter: function () {
								return this.y + " Order";
							},
						},
					},
				},

				tooltip: {
					useHTML: true,

					formatter: function () {
						var points = this.point;
						// console.log(this.y);
						return (
							`<span style="color:{series.color}"> <b>` +
							points.name +
							` </b></span><br/>
								<span style="color:{series.color}">Total Order : <b>` +
							points.y +
							`</b></span><br/>`
						);
					},
				},

				series: [
					{
						name: "Tahun",
						colorByPoint: true,
						data: a,
					},
				],
				drilldown: {
					breadcrumbs: {
						position: {
							align: "right",
						},
					},
					series: b,
				},
			});
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// Ketika ada error
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
		},
	});
});
