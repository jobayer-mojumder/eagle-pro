<?php
include('../../db_connect.php');
$boss = $_POST['boss'];


if ($boss == "sales_officer")
    $search_for = "supervisor";
else if ($boss == "supervisor")
    $search_for = "manager";
else if ($boss == "manager")
    $search_for = "head";
else if ($boss == "head")
    $search_for = "null";

$stmt = $conn->prepare("SELECT * FROM post_table WHERE post_title = '$search_for'");
$stmt->execute();
$result = $stmt->fetchall();
$output = '<option value = "">Select</option>';

$count = 1;

foreach ($result as $row) {
    $output .= '<option value = "'. $row['post_id'] .'">'. $row["post_title"]. '-'. $count . '</option>';
    $count++;
}
echo $output;


?>
