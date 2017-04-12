<?php
	include('db_connect.php');
        try {

            $stmt = $conn->prepare("SELECT * FROM  `monitor_table` 
				WHERE user_id =2
				AND last_entry LIKE  '2016-12%'
				ORDER BY last_entry ASC ");
            $stmt->execute();
            $rowNo=$stmt->rowCount();
            $result = $stmt->fetchall();
        } catch (Exception $e) {
            return "error";
        }
?>



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="col-lg-12" style="padding:0;margin:0;">
        <div class="panel panel-default">
            <div class="panel-heading">Attendance</div>
			<div class="panel-body">
				<div class="row">
					<table class="table table-bordered">
						<thead class="bg-primary">
						  <tr>
							<th>Name</th>
							<?php
								for($i=1;$i<=31;$i++){echo'<th>'.$i.'</th>';}
							?>
						  </tr>
						</thead>
						<tbody>
							<td>Motiur Rahaman</td>
							<?php
								
										for($i=1;$i<=31;$i++){
											$counter=1;
											if($i<9){
												$lol="0".$i;
											}else{
												$lol=$i;
											}
											foreach($result as $res){
												$counter++;
												$hm=$res['last_entry'];
												$temp=explode(" ",$hm)[0];
												$temp2=explode("-",$temp)[2];//echo$temp2."<br>";
												if($lol==$temp2){
													echo'<td>Y</td>';
													break;
												}
												
											}
											if($counter==$rowNo){
													echo'<td>N</td>';
												}
											$counter=1;
										}
										
							?>
						  
						</tbody>
					  </table>
				</div>
			</div>
		</div>
	</div>

</div>
