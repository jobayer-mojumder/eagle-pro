<?php
    include('../../db_connect.php');


    $stmt = $conn->prepare("SELECT * FROM target_table WHERE post_id=:post_id and month = :month");
    $stmt->bindParam(':post_id', $_POST['post_id']); 
    $stmt->bindParam(':month', $_POST['month']); 
    $stmt->execute(); 
    $result = $stmt->fetchall(); 
                            
    $temp=count($result);

    if ($temp != 1)
    {
        $stmt = $conn->prepare("INSERT INTO target_table (post_id, month, amount, year) VALUES (:post_id, :month, :amount, :year)");
        $stmt->bindParam(':post_id', $_POST['post_id']); 
        $stmt->bindParam(':month', $_POST['month']); 
        $stmt->bindParam(':amount', $_POST['amount']);
        $stmt->bindParam(':year', $_POST['year']); 
        if ($stmt->execute())
            echo "1";
        else
            echo "0";
    }
    else
    {
        //echo "11";
       
        $stmt = $conn->prepare("UPDATE target_table SET amount = :amount WHERE id = :id");
        $stmt->bindParam(':id', $result[0]['id']); 
        $stmt->bindParam(':amount', $_POST['amount']); 

        if ($stmt->execute())
            echo "11";
        else
            echo "0";
    }


?>
