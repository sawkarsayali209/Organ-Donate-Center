<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
session_start();
require('con_pg.php');

if (isset($_GET['id'])) {
    $donor_id = $_GET['id'];

    if (!empty($donor_id)) {
        $donor_id = pg_escape_string($con, $donor_id);
        $query = "DELETE FROM donor1 WHERE donor_id = '$donor_id'";


        $result = pg_query($con, $query);

        if ($result) {
            echo "<script> Delete SucessFully</script>";
            header("Location: searchdonor.php");
            exit();
        } else {
            echo "Error deleting record: " . pg_last_error($con);
        }
    } else {
        echo "Invalid DonorID.";
    }
} else {
    echo "Donor ID not provided.";
}
?>
