<?php
    include('db_connect.php');
    //$conn= getDb();
    
    
    $stmt = $conn->prepare("SELECT * FROM service_table WHERE service_id = :service_id");
    $stmt->bindParam(':service_id', $_POST['service_id']);
    $stmt->execute();
    $result = $stmt->fetchall();
    

    foreach ($result as $row) {
        echo $row['service_price'];
    }

?>
