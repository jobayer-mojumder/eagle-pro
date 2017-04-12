<?php 
include('../../db_connect.php');
    
    $output = "<thead>
                   <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Amount</th>
                        <th>Action</th>
                   </tr>
               </thead>
               
               <tbody>";
                       
     $stmt = $conn->prepare("SELECT t2.post_title, t2.post_id, t2.user_id, user_table.full_name, target_table.month, target_table.amount 
FROM post_table as t1 JOIN post_table as t2 on t1.post_id = t2.boss_id

LEFT JOIN user_table on t2.user_id = user_table.user_id 

LEFT JOIN target_table on t2.post_id = target_table.post_id AND target_table.month = :month

WHERE  t1.user_id = :user_id ");
                            
                           

                           $stmt->bindParam(':user_id', $_POST['user_id']);
                           $stmt->bindParam(':month', $_POST['month']);
                           //$stmt->bindParam(':year', $_POST['year']);

                        $stmt->execute();
                        $result = $stmt->fetchall();
                        
                        if (!count($result)) 
                        {
                            echo "No result found";
                            exit();
                        }
                        
                        $count = 0;
                        $conn='';
                        foreach ($result as $row) {
                            $count++;
                            $output .= '
                                <tr>
                                <td>'.$count.'</td>
                                <td>'.$row["full_name"].'</td>
                                <td>'.$row["post_title"]. '</td>
                                <td>'.$row["amount"].'</td>
                                <td><button type="button"  class="btn btn-primary" id = " '. $row["post_id"]. '">Modify</button></td>
                                
                            </tr>';
                        }

                        $output .= '</tbody>';
                        echo  $output;
                        
?>
