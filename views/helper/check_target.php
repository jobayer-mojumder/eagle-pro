<?php
    include('../../db_connect.php');


    $stmt = $conn->prepare("SELECT * FROM target_table WHERE post_id=:post_id and month = :month");
    $stmt->bindParam(':post_id', $_POST['post_id']); 
    $stmt->bindParam(':month', $_POST['month']); 
    $stmt->execute(); 
    $result = $stmt->fetchall(); 
                            
    $temp=count($result); 

    if ($temp)
    {
        echo json_encode($result[0]);
    }
    else
        echo "0";    
?>
