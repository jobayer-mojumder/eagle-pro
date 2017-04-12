<?php
    ob_start();
    $servername = "localhost";
    $Dbusername = "root";
    $Dbpassword = "";
    $db="weopenco_eaglepro";
  try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $Dbusername, $Dbpassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

?>
