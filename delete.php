<?php
    include('db_connect.php');
    $id=($_GET['id']);
    $table_name=($_GET['table_name']);echo$table_name;
    if($table_name=='user_table'){
        try {
        
            $delete="UPDATE post_table SET user_id = 0, status = 0 WHERE user_id='$id'";
            $conn->exec($delete);

            $delete="DELETE FROM user_table WHERE user_id='$id'";
            $conn->exec($delete);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }catch(Exception $e){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else if($table_name=='shop_table'){
        try {
            $id=base64_decode ($id);
            $delete="DELETE FROM  shop_table WHERE  shop_id='$id'";
            $conn->exec($delete);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }catch(Exception $e){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else if($table_name=='product_table'){
        try {
            $delete="DELETE FROM  product_table WHERE  id='$id'";
            $conn->exec($delete);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }catch(Exception $e){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else if($table_name=='target_table'){
        try {

            $delete="DELETE FROM  target_table WHERE  id='$id'";
            $conn->exec($delete);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }catch(Exception $e){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else  if($id=='company_table'){
        echo'You Cant Delete Company';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        try {

            /*$delete="DELETE FROM  company_table WHERE  cmp_id='$id'";
            $conn->exec($delete);
            $msg=1;*/
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }catch(Exception $e){
            echo'You Cant Delete Company';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

?>