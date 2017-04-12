<?php 
include('../../db_connect.php');
    
     $boss_id = $_POST['boss_id'];
     $output = "<option value='0'>-Select-</option>";
                       
     $stmt = $conn->prepare("SELECT post_id, user_table.full_name FROM `post_table`
            LEFT JOIN user_table ON user_table.user_id = post_table.user_id
            WHERE boss_id = :boss_id");
     $stmt->bindParam(':boss_id', $boss_id);
                            
     $stmt->execute();
     $result = $stmt->fetchall();
                        
     foreach ($result as $row) {   
        if ($row["full_name"] == '')
            $output .= '<option value = '. $row["post_id"]. '>Not Assigned</option>';
        
        else                         
            $output .= '<option value = '. $row["post_id"]. '>'.$row["full_name"].'</option>';
     }    
     echo  $output;
                        
?>
