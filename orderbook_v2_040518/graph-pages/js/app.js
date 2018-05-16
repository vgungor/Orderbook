$(document).ready(function(){
	$.ajax({
		url: "http://localhost/orderbook/orderbook_v2_040518/graph-pages/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var tarih = [];
			var sayi = [];

			for(var i in data) {
				tarih.push("tarih " + data[i].tarih);
				sayi.push(data[i].sayi);
			}

			var chartdata = {
				labels: tarih,
				datasets : [
					{
						label: 'Siparis sayi',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: sayi
					}
				]
			};
			//options
			var options = {
				responsive: true,
				title: {
					display: true,
					position: "top",
					text: "Gün - Sipariş sayısı",
					fontSize: 18,
					fontColor: "#111"
				},
				legend: {
					display: true,
					position: "bottom",
					labels: {
						fontColor: "#333",
						fontSize: 16
					}
				},
				scales: {
					yAxes: [{
						ticks: {
							min: 0,
							stepSize: 1
						}
					}]
				}
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
				options: options
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});