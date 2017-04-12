<?php


class CreateTable
{
    function createUserTable()
    {
        include('db_connect.php');
        try {
            $sql = "CREATE TABLE IF NOT EXISTS user_table (
                        user_id INT AUTO_INCREMENT PRIMARY KEY,
                        username VARCHAR(255) UNIQUE,
                        password VARCHAR(100),
                        full_name VARCHAR(100),
                        designation VARCHAR(100),
                        cmp_id INT,
                        dateofbirth DATE,
                        imageref VARCHAR(255),
                        blood_group VARCHAR(100),
                        phone VARCHAR(50) ,
                        user_type VARCHAR(100),
                        assigned_status INT,
                        status INT,
                        regtime TIMESTAMP
                        )";
            $conn->exec($sql);
            //print("Created  Table.\n");
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
    
    function createTargetTable()
    {
        include('db_connect.php');
        try {
            $sql = "CREATE TABLE IF NOT EXISTS `target_table` (
                id int(11) NOT NULL AUTO_INCREMENT PRIMARY key,
		company_id int,
                post_id int(11) DEFAULT NULL,
                month varchar(100) DEFAULT NULL,
                amount int(11) DEFAULT NULL,
                year VARCHAR(20),
                status int(11) DEFAULT NULL,
                insert_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
            $conn->exec($sql);
            //print("Created  Table.\n");
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }


    function createAchieveTable()
    {
        include('db_connect.php');
        try {
            $sql = "CREATE TABLE IF NOT EXISTS `achieve_table` (
                  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY key,
		company_id int,
                  `post_id` int(11) DEFAULT NULL,
                  `month` varchar(100) DEFAULT NULL,
                  `year` INT DEFAULT NULL,
                  `total` int(11) DEFAULT NULL,
                  `status` int(11) DEFAULT NULL,
                  `insert_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
            $conn->exec($sql);
            //print("Created  Table.");
           } catch (Exception $e) {
            echo $e->getMessage();
        }

    }


    function createServiceTable()
    {
        include('db_connect.php');
        try {
        $sql = "CREATE TABLE IF NOT EXISTS service_table (
            service_id INT AUTO_INCREMENT PRIMARY KEY,
		company_id int,
            service_name VARCHAR(255),
            service_price INT,
            status int,
            regtime TIMESTAMP
            )";
            $conn->exec($sql);
            //print("Created  Table.\n");
        } catch (Exception $e) {
            //echo$e->getMessage();
        }

    }
    function createPostTable()
    {
        include('db_connect.php');
        try {
            $sql = "CREATE TABLE IF NOT EXISTS `post_table` (
                  post_id INT AUTO_INCREMENT PRIMARY KEY,
		company_id int,
                  post_title varchar(255) DEFAULT NULL,
                  boss_id varchar(100) DEFAULT NULL,
                  area varchar(100) DEFAULT NULL,
                  user_id int(11) NOT NULL,
                  year VARCHAR(20),
                  status int(11) DEFAULT NULL,
                  regtime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
                        )";
            $conn->exec($sql);
            //print("Created  Table.\n");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    function outletTable()
    {
        include('db_connect.php');
        try {
            $sql = "CREATE TABLE IF NOT EXISTS shop_table (
                shop_id INT AUTO_INCREMENT PRIMARY KEY,
                outlet_no VARCHAR(255) UNIQUE,
                company_id int,
                shop_name VARCHAR(255),
                phone VARCHAR(100),
                house_no VARCHAR(100),
                road_no VARCHAR(100),
                thana VARCHAR(100),
                district VARCHAR(255),
                area VARCHAR(255),
                status int,
                regtime TIMESTAMP
            )";
            $conn->exec($sql);
            //print("Created  Table.\n");
        } catch (Exception $e) {
            //echo$e->getMessage();
        }
        $conn = null;
    }

    function  createCompanyTable()
    {
        include('db_connect.php');
        try {
            $sql = "CREATE TABLE IF NOT EXISTS company_table (
                cmp_id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) UNIQUE,
                password VARCHAR(100),
                company_name VARCHAR(100),
                phone VARCHAR(50) ,
                address VARCHAR(255),
                user_type VARCHAR(100),
                regtime TIMESTAMP
                )";
            $conn->exec($sql);
            $pass = md5('3Idiots');//echo$pass;
            $stmt = "INSERT INTO company_table(company_name, username, password,phone,address, user_type)
                VALUES ('Super Admin', 'phunsukhWangdu', '$pass', '01976422773', 'Open Digital Communication', 'super_admin')";
            $conn->exec($stmt);
            //print("Created  Table.\n");
        } catch (Exception $e) {
            echo $e->getMessage();

        }
    }

    //Order Table
    function createOrderTable()
    {
        include('db_connect.php');

        try {
            $sql = "CREATE TABLE IF NOT EXISTS order_table(
            order_id INT AUTO_INCREMENT PRIMARY KEY,
		company_id int,
            salesman_id INT,
            salesman_id_extra INT,
            customer_name VARCHAR(255),
            phone VARCHAR(100),
            address VARCHAR(255),
            nid VARCHAR(100),            
            pickup_date VARCHAR(255),
            pickup_location VARCHAR(255),
            service_type VARCHAR(255),
            service_name VARCHAR(255),
            drop_off_date VARCHAR(255),
            drop_off_location VARCHAR(255),
            vehicle_type VARCHAR(255),
            service_price VARCHAR(100),
            month VARCHAR(20),    
            year VARCHAR(20),           
            latitude VARCHAR(255),
            longitude VARCHAR(255),
            order_placed_at VARCHAR(255),
            status int,
            regtime TIMESTAMP
            )";
            $conn->exec($sql);
            //print("Created  Table.\n");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function createMonitoringTable()
    {
        include('db_connect.php');
        try {
            $sql = "CREATE TABLE IF NOT EXISTS monitor_table(
				at_id INT AUTO_INCREMENT PRIMARY KEY,
				company_id INT,
				user_id INT,
				latitude FLOAT,
				longitude FLOAT,
				address VARCHAR(255),
				last_entry TIMESTAMP
				)";
            $conn->exec($sql);
            //print("attendance_table Created  Table.\n");
        } catch (Exception $e) {
            //echo$e->getMessage();
        }
    }


}

?>
