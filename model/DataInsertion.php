<?php
/**
 * Created by PhpStorm.
 * User: Open Communication
 * Date: 11/24/2016
 * Time: 5:14 PM
 */

class DataInsertion {

    function addCompanyInfo($company_name, $email, $password,$phone,$address,$user_type){
        include('db_connect.php');
        try {
            $stmt = $conn->prepare("INSERT INTO company_table(company_name, username, password,phone,address, user_type)
                VALUES (:company_name, :username, :password, :phone, :address, :user_type)  ");
            $stmt->bindParam(':company_name', $company_name);
            $stmt->bindParam(':username', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':user_type', $user_type);
            $stmt->execute();
            return 1;
        } catch (Exception $e) {
            //echo $e->getMessage();
           return 5;

        }

    }
    
    function addOrder($salesman_id, $customer_name, $phone, $address, $nid, $pickup_date, $pickup_location, 
                $service_type, $drop_off_date, $drop_off_location, $service_price, $month, $year, $latitude,$longitude,$order_placed_at, $status){
        include('db_connect.php');
           try {
                $stmt = $conn->prepare("INSERT INTO order_table (salesman_id, customer_name, phone, address, nid, pickup_date, pickup_location, 
                service_type, drop_off_date, drop_off_location, service_price, month, year, latitude,longitude,order_placed_at, status) VALUES (
                  :salesman_id, :customer_name, :phone, :address, :nid, :pickup_date, :pickup_location, 
                  :service_type, :drop_off_date, :drop_off_location, :service_price, :month, :year, :latitude,:longitude,:order_placed_at,:status)");
                  
                $stmt->bindParam(':salesman_id', $salesman_id);
                $stmt->bindParam(':customer_name', $customer_name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':nid', $nid);
                $stmt->bindParam(':pickup_date', $pickup_date);
                $stmt->bindParam(':pickup_location', $pickup_location);
                $stmt->bindParam(':service_type', $service_type);
                $stmt->bindParam(':drop_off_date', $drop_off_date);
                $stmt->bindParam(':drop_off_location', $drop_off_location);
                $stmt->bindParam(':service_price', $service_price);
                $stmt->bindParam(':month', $month);
                $stmt->bindParam(':year', $year);
                $stmt->bindParam(':latitude', $lat);
                $stmt->bindParam(':longitude', $lon);
                $stmt->bindParam(':order_placed_at', $address);
                $stmt->bindParam(':status', $status);
                $stmt->execute();
                return 1;
            } catch (Exception $e) {
                echo $e->getMessage();
                return 5;
            }
    }

} 
