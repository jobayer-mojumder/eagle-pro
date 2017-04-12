<?php
    include('../../db_connect.php');
    
    $res = array();
    $post_id = $_POST['boss_id'];
    
    $post_title = $_POST['post_title'];
    
    $month = $_POST['month'];
    $year = $_POST['year'];
    
    $sql = "";
    
    
    if ($post_title == 'head')
    {
        $sql = "SELECT SUM(t4.total) as total from post_table t1
                JOIN post_table t2 ON t2.boss_id = t1.post_id
                JOIN post_table t3 ON t3.boss_id = t2.post_id
                JOIN achieve_table t4 ON t4.post_id = t3.post_id
                WHERE t1.boss_id = :post_id AND t4.month = :month AND t4.year = :year";
    }    
    else if ($post_title == 'manager')
    {
        $sql = "SELECT SUM(t4.total) as total from post_table t1
                JOIN post_table t2 ON t2.boss_id = t1.post_id
                JOIN achieve_table t4 ON t4.post_id = t2.post_id
                WHERE t1.boss_id = :post_id AND t4.month = :month AND t4.year = :year";        
    }    
    else if ($post_title == 'supervisor')
    {
        $sql = "SELECT SUM(t4.total) as total from post_table t1
                JOIN achieve_table t4 ON t4.post_id = t1.post_id
                WHERE t1.boss_id = :post_id AND t4.month = :month AND t4.year = :year";        
    }
    else if ($post_title == 'sales_officer')
    {
        $sql = "SELECT SUM(total) as total FROM achieve_table
                WHERE post_id = :post_id AND month = :month AND year = :year";      
    }
    

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':post_id', $_POST['boss_id']); 
    $stmt->bindParam(':month', $_POST['month']); 
    $stmt->bindParam(':year', $_POST['year']); 
    $stmt->execute(); 
    $result = $stmt->fetchall(); 
                            
    $res['achieved'] = $result[0]['total'];
    
    
    $sql = "SELECT user_table.full_name, target_table.amount FROM `target_table` 
JOIN post_table ON post_table.post_id = target_table.post_id
JOIN user_table ON user_table.user_id = post_table.user_id
WHERE target_table.post_id = :post_id AND target_table.month = :month AND target_table.year = :year";      
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':post_id', $_POST['boss_id']); 
    $stmt->bindParam(':month', $_POST['month']); 
    $stmt->bindParam(':year', $_POST['year']); 
    $stmt->execute(); 
    $result = $stmt->fetchall();
    
    $res['full_name'] = $result[0]['full_name']; 
    $res['target'] = $result[0]['amount']; 
    
    echo json_encode($res);

?>
