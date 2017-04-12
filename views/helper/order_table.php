<?php
    include('db_connect.php');
    
       $stmt = $conn->prepare("SELECT user_table.full_name, order_table.order_id, order_table.salesman_id, order_table.customer_name, order_table.pickup_date, 
        order_table.drop_off_date, order_table.service_price, order_table.status,
        order_table.pickup_location,order_table.drop_off_location, order_table.phone,
        order_table.nid, order_table.address,order_table.order_placed_at,
        service_table.service_name FROM `order_table` 
        JOIN service_table ON order_table.service_type = service_table.service_id
        JOIN post_table ON post_table.post_id = order_table.salesman_id
        JOIN user_table ON user_table.user_id = post_table.user_id  ORDER BY order_table.order_id DESC LIMIT 200");
        
        $stmt->execute();
        $rowNo=$stmt->rowCount();
        $result = $stmt->fetchall();
        $count = 1;
    ?>
                    
                        <thead>
                        <?php
                        echo '<tr>
                            <th>SL</th>
                            <th style = "display: none">Salesman Id</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>NID</th>
                            <th>Service Name</th>
                            <th>PickUp Location</th>
                            <th>PickUp Date</th>
                            <th>Drop Off Location</th>
                            <th>Drop Off Date</th>
                            <th>Service Cost</th>
                            <th>Salesman Name</th>
                            <th>Order Placed</th>
                            <th>Action</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>';
                        if($rowNo<1){
                            echo "No new order<br>";
                        }
                        else{
                            foreach ($result as $row) {
                            echo '<tr>
                                <td>'.$count++.'</td>
                                <td  style = "display: none">'.$row["salesman_id"].'</td>
                                <td>'.$row["customer_name"].'</td>
                                <td>'.$row["phone"].'</td>
                                <td>'.$row["address"].'</td>
                                <td>'.$row["nid"].'</td>
                                <td>'.$row["service_name"].'</td>
                                <td>'.$row["pickup_location"].'</td>
                                <td>'.$row["pickup_date"].'</td>
                                <td>'.$row["drop_off_location"].'</td>
                                <td>'.$row["drop_off_date"].'</td>
                                <td>'.$row["service_price"].'</td>
                                <td>'.$row["full_name"].'</td>
                                <td>'.$row["order_placed_at"].'</td>
                                ';
                                
                              
                                    if ($row['status'] <= 0)
                                    {
                                        
                                        echo '<td class = "approve"><a id = "'. $row['order_id']. '" type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-plus-square" aria-hidden="true"></i> Approve</a></td>';
                                        echo '<td class = "decline"><a id = "'. $row["order_id"].'" type="button" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Decline</a></td>';
                                    }
                                    else if ($row['status'] == 1)
                                    {
                                        echo '<td>Approved</td><td class = "decline"><a id = "'. $row["order_id"].'" type="button" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Decline</a></td>';
                                    }
                                    else
                                    {
                                        echo '<td class = "approve"><a id = "'. $row['order_id']. '" type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-plus-square" aria-hidden="true"></i> Approve</a></td><td>Declined</td>';
                                    }
                               
                            echo '</tr>';
                        }
                        }
                        ?>
                        </tbody>
                    

