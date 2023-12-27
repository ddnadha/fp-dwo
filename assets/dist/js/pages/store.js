$(async function () {
	$("#data_store").DataTable();

	await $.ajax({
		type: "POST",
		url: base_url + "/Store/regionSales",
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