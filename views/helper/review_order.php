<?php

    include('../../db_connect.php');
    $order_id = $_POST['order_id'];
    
    $year = date('Y');
    $stmt = $conn->prepare("SELECT month, salesman_id, service_price, status from order_table WHERE order_id = $order_id"); 
        $stmt->execute();
        $result = $stmt->fetchall();
        $month = $result[0]['month'];
        $amount = $result[0]['service_price'];
        $post_id = $result[0]['salesman_id'];
        $status = $result[0]['status'];
        
       // echo $order_id . " ". $month . " ". $amount . " ". $salesman_id ;
    
    function exists($post_id, $month, $stmt, $conn, $result)
    {
        $stmt = $conn->prepare("SELECT id from achieve_table WHERE post_id = $post_id AND month = '$month'"); 
        $stmt->execute();
        $count = $stmt->rowCount();
            
        if ($count == 1)
        {
            $result = $stmt->fetchall();
            return $result[0]['id'];
        } 
        else
            return 0;       
    }
  
    $id = exists($post_id, $month, $stmt, $conn, $result);
     
  
     if ($_POST['operation'] == "approve") 
     {
     
        if ($status == 0 || $status == 2)
        {
            $stmt = $conn->prepare("UPDATE order_table SET status = 1 WHERE order_id = $order_id"); 
            $stmt->execute(); 
            
            if ($id)
            {
                  $stmt = $conn->prepare("UPDATE achieve_table SET total = total + $amount WHERE id = $id"); 
                  $stmt->execute();    
            }
            else
            {
                $stmt = $conn->prepare("Insert into achieve_table (post_id, month, total, year) VALUES ($post_id, '$month', $amount, '$year')"); 
                $stmt->execute();
            }
        }      
    } 
     else
     {
     
        if ($status == 1)
        {
            $stmt = $conn->prepare("UPDATE order_table SET status = 2 WHERE order_id = $order_id"); 
            $stmt->execute(); 
            
            if ($id)
            {
                  $stmt = $conn->prepare("UPDATE achieve_table SET total = total - $amount WHERE id = $id"); 
                  $stmt->execute();    
            }            
        } 
        
        else if ($status == 0)
        {
            $stmt = $conn->prepare("UPDATE order_table SET status = 2 WHERE order_id = $order_id"); 
            $stmt->execute();            
        }      
    }   
?>
