<?php
$stmt = $conn->prepare("SELECT * FROM service_table");
        $stmt->execute();
		$rowNo=$stmt->rowCount();
        $result = $stmt->fetchall();
        echo "<option>--select--</option>";
        foreach ($result as $row) {
		 echo "<option value='".$row['service_id']."'>".$row['service_name']."</option>";
	}
?>