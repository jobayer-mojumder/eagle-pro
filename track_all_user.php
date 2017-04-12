    <?php
        include('db_connect.php');
		$tempValues=" Result shown for today";
		if(isset($_POST['save'])){
			$month=$_POST['month'];
			 $time= $date = date('Y');#echo$t;
			 $time=$time."-".$month;
			 $tempValues="";
		}else{
			 $time= $date = date('Y-m-d');#echo$t;
		}
       
        $stmt = $conn->prepare("SELECT * FROM monitor_table WHERE last_entry LIKE '$time%'"); 
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $rowNo=$stmt->rowCount();
        $result = $stmt->fetchall();
        $count = 0;
    ?>
        <head>
        
        <style>

			html, body {
					margin: 0;
					padding: 0;
					height: 100%;
					width: 100%;
				}
			#map-canvas {
				width: 1000px; height: 500px;
			}

			#iw_container .iw_title {
				font-size: 16px;
				font-weight: bold;
			}
			.iw_content {
				padding: 15px 15px 15px 0;
			}
        </style>
            
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        </head>
        
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		
		<div class="row">
			<ol class="breadcrumb">
				Real Time Monitoring
			</ol>
		</div>
	
        <div class="col-lg-12">
            <div class="panel panel-default">
               <div class="panel-heading">Realtime Monitoring<small><?php echo$tempValues;?></small></div><br>
				 <form role="form" method="post" action="">
							<div class="form-group col-sm-6">
                                <select class="form-control" id="select_month" name="month">
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
							<div class="form-group col-sm-6">
								<button type="submit" name='save'  class="btn btn-primary" id="search"><span class="glyphicon glyphicon-search" ></span></button>
								
							</div>
                       
                    </form>
                <div class="panel-body">
                    <table class="table table-bordered table-responsive">
                        <thead>
                        
                        <?php
                        if($rowNo<1){
                            echo'List is empty.';
                        }else{
                            echo'<tr>
                            <th>SL</th>
                            <th>Employee Name</th>
                            <th>Latitude</th>
                            <th>Longtitude</th>
                            <th>Address</th>
                            <th>Last Entry</th>
                        </tr>
                        </thead>
                        <tbody>';
                        }
                        
                        $rows = array();
                        foreach ($result as $row) {
                            $myEmp=$row['user_id'];
                            $myst = $conn->prepare("SELECT * FROM user_table WHERE user_id=$myEmp");
                            $myst->execute();
                             $ret = $myst->fetchall();
                            foreach ($ret as $r) {
                                $user_name=$r['full_name'];
                            }

                            $row['name'] = $user_name;
                            $rows[] = $row;         
                            
                            $count++;
                            ?>
                            <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $user_name; ?></td>
                                <td><?php echo $row['latitude']; ?></td>
                                <td><?php echo $row['longitude']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['last_entry']; ?></td>
                                
                            </tr>



                        <?php
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
                <div class="row">
            <div class="col-sm-12">
                
                <div id = "map-canvas"></div>
            
            </div>
        </div>
            </div>
        </div>
        
        
        
    </div>
    
</div>

  <script>
		var map;
		var infoWindow;

		var markersData = <?php echo json_encode($rows) ?>;


		function initialize() {
		   var mapOptions = {
			  center: new google.maps.LatLng(23.8103,90.4125),
			  zoom: 9,
			  mapTypeId: 'roadmap',
		   };

		   map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		   
		   infoWindow = new google.maps.InfoWindow();

		   google.maps.event.addListener(map, 'click', function() {
			  infoWindow.close();
		   });

			displayMarkers();
		}
		google.maps.event.addDomListener(window, 'load', initialize);


		function displayMarkers(){

		   var bounds = new google.maps.LatLngBounds();
		   
		   for (var i = 0; i < markersData.length; i++){
			  var latlng = new google.maps.LatLng(markersData[i].latitude, markersData[i].longitude);
			  var name = markersData[i].name;
			  var address = markersData[i].address;
			  var lastEntry = markersData[i].last_entry;

			  createMarker(latlng, name, address, lastEntry);

			  bounds.extend(latlng);  
		   }

		   map.fitBounds(bounds);
		}

		function createMarker(latlng, name, address, lastEntry){
		   var marker = new google.maps.Marker({
			  map: map,
			  position: latlng,
			  title: name
		   });

		   google.maps.event.addListener(marker, 'click', function() {
			  
			  var iwContent = '<div id="iw_container">' +
					'<div class="iw_title">' + name + '</div>' +
				 '<div class="iw_content">' + address + '<br />' +         
				 lastEntry + '</div></div>';
			  
			  infoWindow.setContent(iwContent);

			  infoWindow.open(map, marker);
		   });
		}

    </script>
