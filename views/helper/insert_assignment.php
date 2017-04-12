<?php    
    include('../../db_connect.php');
    
    $stmt = $conn->prepare("SELECT * FROM post_table WHERE user_id=:user_id and status = 1");
    $stmt->bindParam(':user_id', $_POST['user_id']);
    $stmt->execute(); 
    $result = $stmt->fetchall();                            
                            
    $temp=count($result);
    
    if ($temp != 1)    
    {               
        $stmt = $conn->prepare("UPDATE post_table SET user_id = :user_id, status=1 WHERE post_id=:post_id");
        $stmt->bindParam(':post_id', $_POST['post_id']);
        $stmt->bindParam(':user_id', $_POST['user_id']);
        $stmt->execute(); 
        
        if ($stmt)
        {
            $stmt = $conn->prepare("UPDATE user_table SET assigned_status=1 WHERE user_id=:user_id");
            $stmt->bindParam(':user_id', $_POST['user_id']);  
            $stmt->execute();
            if ($stmt)
            {
                echo "Assigned Successfully"; 
            }            
        }
   
    }
    else
    {
        echo "An Error Occurred";
    }
?>
