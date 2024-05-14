<?php
session_start();
include 'con_pg.php'; 

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_Login.php');
    exit();
}

if (!isset($_GET['patient_id']) || !isset($_GET['organ']) || !isset($_GET['upi_id'])) {
    header('Location: admin.php');
    exit();
}

$patientId = $_GET['patient_id'];
$organ = $_GET['organ'];

$deleteQuery = "DELETE FROM Organ_Required WHERE patient_id = '$patientId' AND organ = '$organ' ";
$deleteResult = pg_query($con, $deleteQuery);

if ($deleteResult) {
    header('Location: admin.php');
    exit();
} else {
  $errorMessage = "Failed to delete requirement.";
}

pg_close($con);
?>
