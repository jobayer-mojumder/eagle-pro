<?php
    include('../db_connect.php');
    try {
        $sql = "CREATE TABLE IF NOT EXISTS query_table (
                        query_id INT AUTO_INCREMENT PRIMARY KEY,
                        subject VARCHAR(255),
                        detail_msg VARCHAR(255),
                        cmp_id INT,
                        user_id INT,
                        area VARCHAR(255),
                        insert_time TIMESTAMP
                        )";
        $conn->exec($sql);
        print("Created  Table.\n");
    } catch (Exception $e) {
        echo$e->getMessage();
    }


    if(isset($_GET['user_id'])) {
        $company_id=$_GET['company_id'];
        $area=$_GET['area'];
        $user_id =$_GET['user_id'];
        $subject=$_GET['subject'];
        $detail_msg=$_GET['detail_msg'];

        try {
            $stmt = $conn->prepare("INSERT INTO query_table ( cmp_id , user_id , area,subject,detail_msg)
			VALUES ( :company_id , :user_id , :area,:subject,:detail_msg) ");
            $stmt->bindParam(':company_id', $company_id);
            $stmt->bindParam(':user_id', $user_id );
            $stmt->bindParam(':area', $area);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':detail_msg', $detail_msg);

            $stmt->execute();

            echo'Ok';
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
?>