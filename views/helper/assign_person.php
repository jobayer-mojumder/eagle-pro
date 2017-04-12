<?php

    include('../../db_connect.php');
    $post_title = $_POST['post_title'];



    $stmt = $conn->prepare("SELECT * FROM user_table WHERE designation = '$post_title' AND assigned_status = 0");
    $stmt->execute();
    $result = $stmt->fetchall();
    $output = '<option value = "0">Select</option>';

    foreach ($result as $row) {
        $output .= '<option value = "'. $row['user_id'] .'">'. $row["full_name"] . '</option>';
    }
    echo $output;


?>
