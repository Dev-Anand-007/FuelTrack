<?php
session_start();
include '../../assets/constant/config.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['submit'])) {

        $stmt = $conn->prepare("INSERT INTO `add_stock` (`fuel_type`, `date`, `morning_density`, 
        `morning_temp`, `morning_observed`, `invoice_number`, `volume`, `vehicle_number`, `fuel_price`, 
        `truck_density`, `truck_temp`, `truck_observed`, `after_decantation_density`, `after_decantation_temp`, 
        `after_decantation_observed`) VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Apply htmlspecialchars to user inputs
        $fuel_type = htmlspecialchars($_POST['fuel_type'], ENT_QUOTES, 'UTF-8');
        $date = htmlspecialchars($_POST['date'], ENT_QUOTES, 'UTF-8');
        $morning_density = htmlspecialchars($_POST['morning_density'], ENT_QUOTES, 'UTF-8');
        $morning_temp = htmlspecialchars($_POST['morning_temp'], ENT_QUOTES, 'UTF-8');
        $morning_observed = htmlspecialchars($_POST['morning_observed'], ENT_QUOTES, 'UTF-8');
        $invoice_number = htmlspecialchars($_POST['invoice_number'], ENT_QUOTES, 'UTF-8');
        $volume = htmlspecialchars($_POST['volume'], ENT_QUOTES, 'UTF-8');
        $vehicle_number = htmlspecialchars($_POST['vehicle_number'], ENT_QUOTES, 'UTF-8');
        $fuel_price = htmlspecialchars($_POST['fuel_price'], ENT_QUOTES, 'UTF-8');
        $truck_density = htmlspecialchars($_POST['truck_density'], ENT_QUOTES, 'UTF-8');
        $truck_temp = htmlspecialchars($_POST['truck_temp'], ENT_QUOTES, 'UTF-8');
        $truck_observed = htmlspecialchars($_POST['truck_observed'], ENT_QUOTES, 'UTF-8');
        $after_decantation_density = htmlspecialchars($_POST['after_decantation_density'], ENT_QUOTES, 'UTF-8');
        $after_decantation_temp = htmlspecialchars($_POST['after_decantation_temp'], ENT_QUOTES, 'UTF-8');
        $after_decantation_observed = htmlspecialchars($_POST['after_decantation_observed'], ENT_QUOTES, 'UTF-8');
        
        

        $stmt->execute([$fuel_type, $date, $morning_density, 
        $morning_temp, $morning_observed, $invoice_number, $volume, $vehicle_number, $fuel_price, 
        $truck_density, $truck_temp, $truck_observed, $after_decantation_density, $after_decantation_temp, 
        $after_decantation_observed]);

        $_SESSION['success'] = "success";

        header("location:../manage_stock.php");
    }

    if (isset($_POST['update'])) {

        $stmt = $conn->prepare("UPDATE `add_stock` SET `fuel_type`=?, `date`=?, `morning_density`=?,
        `morning_temp`=?, `morning_observed`=?, `invoice_number`=?, `volume`=?,`vehicle_number`=?,
        `fuel_price`=?,`truck_density`=?,`truck_temp`=?,`truck_observed`=?,`after_decantation_density`=?,
        `after_decantation_temp`=?,`after_decantation_observed`=? WHERE id=? ");

        // Apply htmlspecialchars to user inputs
        $fuel_type = htmlspecialchars($_POST['fuel_type'], ENT_QUOTES, 'UTF-8');
        $date = htmlspecialchars($_POST['date'], ENT_QUOTES, 'UTF-8');
        $morning_density = htmlspecialchars($_POST['morning_density'], ENT_QUOTES, 'UTF-8');
        $morning_temp = htmlspecialchars($_POST['morning_temp'], ENT_QUOTES, 'UTF-8');
        $morning_observed = htmlspecialchars($_POST['morning_observed'], ENT_QUOTES, 'UTF-8');
        $invoice_number = htmlspecialchars($_POST['invoice_number'], ENT_QUOTES, 'UTF-8');
        $volume = htmlspecialchars($_POST['volume'], ENT_QUOTES, 'UTF-8');
        $vehicle_number = htmlspecialchars($_POST['vehicle_number'], ENT_QUOTES, 'UTF-8');
        $fuel_price = htmlspecialchars($_POST['fuel_price'], ENT_QUOTES, 'UTF-8');
        $truck_density = htmlspecialchars($_POST['truck_density'], ENT_QUOTES, 'UTF-8');
        $truck_temp = htmlspecialchars($_POST['truck_temp'], ENT_QUOTES, 'UTF-8');
        $truck_observed = htmlspecialchars($_POST['truck_observed'], ENT_QUOTES, 'UTF-8');
        $after_decantation_density = htmlspecialchars($_POST['after_decantation_density'], ENT_QUOTES, 'UTF-8');
        $after_decantation_temp = htmlspecialchars($_POST['after_decantation_temp'], ENT_QUOTES, 'UTF-8');
        $after_decantation_observed = htmlspecialchars($_POST['after_decantation_observed'], ENT_QUOTES, 'UTF-8');
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

        $stmt->execute([$fuel_type, $date, $morning_density, 
        $morning_temp, $morning_observed, $invoice_number, $volume, $vehicle_number, $fuel_price, 
        $truck_density, $truck_temp, $truck_observed, $after_decantation_density, $after_decantation_temp, 
        $after_decantation_observed, $id]);

        $_SESSION['update'] = "update";
        header("location:../manage_stock.php");
    }

    if (isset($_POST['del_id'])) {

        $stmt = $conn->prepare("UPDATE `add_stock` SET delete_status='1' WHERE id=? ");

        // Apply htmlspecialchars to user inputs
        $del_id = htmlspecialchars($_POST['del_id'], ENT_QUOTES, 'UTF-8');

        $stmt->execute([$del_id]);

        $_SESSION['delete'] = "delete";

        header("location:../manage_stock.php");
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
