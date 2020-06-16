window.onload = function () {
    
/*var dataChoice = [
    //traitement sur array
]*/
	
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	
	title:{
		text:"Classement du sondage"
	},
	axisX:{
		interval: 1
	},
	axisY2:{
		interlacedColor: "rgba(1,77,101,.2)",
		gridColor: "rgba(1,77,101,.1)",
		
	},
	data: [{
		type: "bar",
		axisYType: "secondary",
		color: "#014D65",
		dataPoints: [
                    
			{ y: 10, label: "Chandler" },
			{ y: 25, label: "Joey" }
		]
	}]
});
chart.render();

};

