

<?php
include('../db_connect.php');
$t= $date = date('Y-m');
$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
$hh=$dt->format('Y-m-d h-i-s');
//echo$hh;

//$statement=$conn->prepare("SELECT company_id, subject, detail_msg,insert_time FROM notice WHERE insert_time LIKE '$t%'");
$statement=$conn->prepare("SELECT company_id, subject, detail_msg,insert_time FROM notice  ORDER BY nt_id DESC LIMIT 20");
$statement->execute();
$results=$statement->fetchAll(PDO::FETCH_ASSOC);
if($results) {
    $json=json_encode($results);
    echo$json;


}else{
    echo '{"status": "error"}';
}

?>



