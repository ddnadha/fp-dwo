$('table').dataTable()
var seriesData = [];
var drilldownData = [];
var childSeriesData = [];
console.log(byCategory)
byCategory.forEach((category) => {
    let _data = {};
    let _childData = {};

    //parent 
    _data.name = category.category
    _data.y = parseFloat(category.qty)
    _data.custom = category.total
    _data.drilldown = category.category

    //child
    category.subcategory.forEach((sub) => {
        _childData.name = sub.sub_category
        _childData.y = parseFloat(sub.qty)
        _childData.custom = sub.total
        childSeriesData.push(_childData)
        _childData = {}
    })
    drilldownData.push({
        name: category.category,
        id: category.category,
        data: childSeriesData
    })
    childSeriesData = []
    seriesData.push(_data)
});

// Create the pie chart
Highcharts.chart("chartByCategory", {
    chart: {
        type: "pie",
    },
    title: {
        text: "Sales by Category Chart",
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
                format: "{point.name}: {point.y}",
            },
        },
    },

    tooltip: {
        useHTML: true,

        formatter: function () {
            var points = this.point;

            return (
                `<span style="color:{series.color}"> <b>` +
                points.name +
                ` </b></span><br/>
                    <span style="color:{series.color}">Sales : <b>` +
                    parseFloat(points.custom).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD'
                  }) +
                `</b></span><br/>`
            );
        },
    },

    series: [
        {
            name: "Category",
            colorByPoint: true,
            data: seriesData,
        },
    ],
    drilldown: {
        series: drilldownData,
    },
});

let seriesDataRegion = []
let drilldownDataRegion = []
let drilldownDataStore = []

byRegion.forEach((region) => {
    let _data = {};
    let _childData = {};
    let _storeData = {};

    //parent 
    _data.name = region.country_region_name
    _data.y = parseFloat(region.qty)
    _data.custom = region.total
    _data.drilldown = region.country_region_name

    //child
    region.territory.forEach((territory) => {
        _childData.name = territory.territory_name
        _childData.y = parseFloat(territory.qty)
        _childData.custom = territory.total
        childSeriesData.push(_childData)
        _childData = {}
    })
    drilldownDataRegion.push({
        name: region.country_region_name,
        id: region.country_region_name,
        data: childSeriesData
    })
    childSeriesData = []
    seriesDataRegion.push(_data)
})
Highcharts.chart("chartByRegion", {
    chart: {
        type: "pie",
    },
    title: {
        text: "Sales by Region Chart",
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
                format: "{point.name}: {point.y}",
            },
        },
    },

    tooltip: {
        useHTML: true,

        formatter: function () {
            var points = this.point;

            return (
                `<span style="color:{series.color}"> <b>` +
                points.name +
                ` </b></span><br/>
                    <span style="color:{series.color}">Sales : <b>` +
                    parseFloat(points.custom).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD'
                  }) +
                `</b></span><br/>`
            );
        },
    },

    series: [
        {
            name: "Region",
            colorByPoint: true,
            data: seriesDataRegion,
        },
    ],
    drilldown: {
        series: drilldownDataRegion,
    },
});

let seriesDataShipment = []
byShipment.forEach((shipment) => {
    let _data = {};
    _data.name = `${shipment.shipment_name} - ${shipment.category}`
    _data.y = parseFloat(shipment.qty)
    _data.custom = shipment.total

    seriesDataShipment.push(_data)
})
Highcharts.chart("chartByShipment", {
    chart: {
        type: "pie",
    },
    title: {
        text: "Sales by Shipment Chart",
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
                format: "{point.name}: {point.y}",
            },
        },
    },

    tooltip: {
        useHTML: true,

        formatter: function () {
            var points = this.point;

            return (
                `<span style="color:{series.color}"> <b>` +
                points.name +
                ` </b></span><br/>
                    <span style="color:{series.color}">Sales : <b>` +
                    parseFloat(points.custom).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD'
                  }) +
                `</b></span><br/>`
            );
        },
    },

    series: [
        {
            name: "Shipment",
            colorByPoint: true,
            data: seriesDataShipment,
        },
    ],
    
});

$(function () {
	$("#data_sales").DataTable();

	const formatter = new Intl.NumberFormat("en-US", {
		style: "currency",
		currency: "USD",
	});

	 $.ajax({
		type: "POST", 
		url: base_url +"/Sales/salesRev", 
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

	 $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url:base_url + "/Sales/salesTrend", // Isi dengan url/path file php yang dituju
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

$('table').dataTable()
var seriesData = [];
var drilldownData = [];
var childSeriesData = [];
console.log(byCategory)
byCategory.forEach((category) => {
    let _data = {};
    let _childData = {};

    //parent 
    _data.name = category.category
    _data.y = parseFloat(category.qty)
    _data.custom = category.total
    _data.drilldown = category.category

    //child
    category.subcategory.forEach((sub) => {
        _childData.name = sub.sub_category
        _childData.y = parseFloat(sub.qty)
        _childData.custom = sub.total
        childSeriesData.push(_childData)
        _childData = {}
    })
    drilldownData.push({
        name: category.category,
        id: category.category,
        data: childSeriesData
    })
    childSeriesData = []
    seriesData.push(_data)
});

// Create the pie chart
Highcharts.chart("chartByCategory", {
    chart: {
        type: "pie",
    },
    title: {
        text: "Sales by Category Chart",
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
                format: "{point.name}: {point.y}",
            },
        },
    },

    tooltip: {
        useHTML: true,

        formatter: function () {
            var points = this.point;

            return (
                `<span style="color:{series.color}"> <b>` +
                points.name +
                ` </b></span><br/>
                    <span style="color:{series.color}">Sales : <b>` +
                    parseFloat(points.custom).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD'
                  }) +
                `</b></span><br/>`
            );
        },
    },

    series: [
        {
            name: "Category",
            colorByPoint: true,
            data: seriesData,
        },
    ],
    drilldown: {
        series: drilldownData,
    },
});

let seriesDataRegion = []
let drilldownDataRegion = []
let drilldownDataStore = []

byRegion.forEach((region) => {
    let _data = {};
    let _childData = {};
    let _storeData = {};

    //parent 
    _data.name = region.country_region_name
    _data.y = parseFloat(region.qty)
    _data.custom = region.total
    _data.drilldown = region.country_region_name

    //child
    region.territory.forEach((territory) => {
        _childData.name = territory.territory_name
        _childData.y = parseFloat(territory.qty)
        _childData.custom = territory.total
        childSeriesData.push(_childData)
        _childData = {}
    })
    drilldownDataRegion.push({
        name: region.country_region_name,
        id: region.country_region_name,
        data: childSeriesData
    })
    childSeriesData = []
    seriesDataRegion.push(_data)
})
Highcharts.chart("chartByRegion", {
    chart: {
        type: "pie",
    },
    title: {
        text: "Sales by Region Chart",
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
                format: "{point.name}: {point.y}",
            },
        },
    },

    tooltip: {
        useHTML: true,

        formatter: function () {
            var points = this.point;

            return (
                `<span style="color:{series.color}"> <b>` +
                points.name +
                ` </b></span><br/>
                    <span style="color:{series.color}">Sales : <b>` +
                    parseFloat(points.custom).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD'
                  }) +
                `</b></span><br/>`
            );
        },
    },

    series: [
        {
            name: "Region",
            colorByPoint: true,
            data: seriesDataRegion,
        },
    ],
    drilldown: {
        series: drilldownDataRegion,
    },
});

let seriesDataShipment = []
byShipment.forEach((shipment) => {
    let _data = {};
    _data.name = `${shipment.shipment_name} - ${shipment.category}`
    _data.y = parseFloat(shipment.qty)
    _data.custom = shipment.total

    seriesDataShipment.push(_data)
})
Highcharts.chart("chartByShipment", {
    chart: {
        type: "pie",
    },
    title: {
        text: "Sales by Shipment Chart",
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
                format: "{point.name}: {point.y}",
            },
        },
    },

    tooltip: {
        useHTML: true,

        formatter: function () {
            var points = this.point;

            return (
                `<span style="color:{series.color}"> <b>` +
                points.name +
                ` </b></span><br/>
                    <span style="color:{series.color}">Sales : <b>` +
                    parseFloat(points.custom).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD'
                  }) +
                `</b></span><br/>`
            );
        },
    },

    series: [
        {
            name: "Shipment",
            colorByPoint: true,
            data: seriesDataShipment,
        },
    ],
    
});
