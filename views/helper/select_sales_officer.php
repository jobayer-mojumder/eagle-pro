<?php
    include('db_connect.php');

    $stmt = $conn->prepare("SELECT post_table.post_id, post_table.post_title, user_table.full_name FROM post_table 
                    LEFT JOIN user_table ON user_table.user_id = post_table.user_id
                    WHERE post_title = 'sales_officer'");
                    
    $stmt->execute();
    $result = $stmt->fetchall();
    $output = '<option value = "0">-Select-</option>';

    $count = 1;

    foreach ($result as $row) {
         if ($row["full_name"] == "")
            $output .= '<option value = "'. $row['post_id'] .'">'. "Sales Officer " . $count . '</option>';
         else
            $output .= '<option value = "'. $row['post_id'] .'">'. $row["full_name"]. '</option>';
            
         $count++;
    }
    echo $output;

?>
