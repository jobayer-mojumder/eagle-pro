<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<div class="row">
<div class="panel panel-default">
<div class="panel-heading">My Target Statistics</div>
<div class="panel-body">
	<div class="col-sm-8">
        <div class="form-inline">
        <form method="post">
            <div class="form-group">
                <select class="form-control" id="month" name="target_month">
                    <option selected value=''>--Select Month--</option>
                    <option value='Jan'>January</option>
                    <option value='Feb'>February</option>
                    <option value='Mar'>March</option>
                    <option value='Apr'>April</option>
                    <option value='May'>May</option>
                    <option value='Jun'>June</option>
                    <option value='Jul'>July</option>
                    <option value='Aug'>August</option>
                    <option value='Sep'>September</option>
                    <option value='Oct'>October</option>
                    <option value='Nov'>November</option>
                    <option value='Dec'>December</option>
                </select>
            </div>

            	<button type="submit" class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search" ></span></button>
        	</form>
        </div>
    </div>
     <div class="col-lg-6s">
            <table class="table table-bordered table-responsive">
            	<thead>
            		<tr>
                		<th>Month</th>
                		<th>Target</th>
                		<th>Fullfilled</th>
                		<th>Shortage</th>
            		</tr>
        	   </thead>
        	   <tbody>
        	        <?php
        	   		    include('controller/FetchValue.php');
        	   		    $abc = new FetchValue();
        	   		    if(isset($_POST['search'] ) && $_POST['target_month'] !==""){
        	   		    	$month = $_POST['target_month'];
        	   		    }
        	   		    else{
        	   		    	$month = date('M');
        	   		    }
        	   		    $res = $abc->salesmanTargetView($_SESSION['post_id'], $month);
        	   		    echo "<tr><td>".$month."</td><td>" . $res['target'] . "</td><td>" . $res['achieved'] . "</td><td>".intval($res['target']-$res['achieved'])."</td></tr>";
        	   		    
        	   		?>  
        		
            	</tbody>
            </table>
            </div>
        </div>
    </div>

        
</div>


</div>

<!DOCTYPE HTML>
<html>

<head>
<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		title:{
			text: "Top Categories of New Year's Resolution"
		},
		exportFileName: "Pie Chart",
		exportEnabled: true,
                animationEnabled: true,
		legend:{
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
		data: [
		{       
			type: "pie",
			showInLegend: true,
			toolTipContent: "{name}: <strong>{y}%</strong>",
			indexLabel: "{name} {y}%",
			dataPoints: [
				{  y: 35, name: "Health", exploded: true},
				{  y: 20, name: "Finance"},
				{  y: 18, name: "Career"},
				{  y: 15, name: "Education"},
				{  y: 5,  name: "Family"},
				{  y: 7,  name: "Real Estate"}
			]
	}
	]
	});
	chart.render();
}
</script>
<script type="text/javascript" src="/assets/script/canvasjs.min.js"></script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>

</html>


<script type="text/javascript" src="/assets/script/canvasjs.min.js"></script>
