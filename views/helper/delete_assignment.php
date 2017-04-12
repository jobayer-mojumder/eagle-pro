<?php
include('../../db_connect.php');

$post_id = $_POST['post_id'];
$user_id = $_POST['user_id'];


$stmt = $conn->prepare("UPDATE post_table SET status = 0, user_id = 0 WHERE post_id = '$post_id'");
$stmt->execute();

$stmt = $conn->prepare("UPDATE user_table SET assigned_status = 0 WHERE user_id = '$user_id'");
$stmt->execute();

?>

