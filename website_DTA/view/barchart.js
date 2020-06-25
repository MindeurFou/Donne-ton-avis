    function reqListener () {
      console.log(this.responseText);
    }
    //il faut installer 
    var oReq = new XMLHttpRequest(); // New request object
    
    oReq.onload = function() {
        // This is where you handle what to do with the response.
        // The actual data is found on this.responseText
        console.log(this.responseText); // Will alert: 42
    };
    oReq.open("get", "../model/api.php?idSurvey=1", true);
    oReq.send();

/*var chart = new CanvasJS.Chart("chartContainer", {
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
                    
			{ y: 50, label: "Chandler" },
			{ y: 25, label: "Joey" }
		]
	}]
});
chart.render();

};*/


