<?php
session_start();
require('con_pg.php');

if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    if (!empty($patient_id)) {
        $patient_id = pg_escape_string($con, $patient_id);

        $query = "DELETE FROM patient WHERE patient_id = '$patient_id'";

        $result = pg_query($con, $query);

        if ($result) {
            header("Location: searchpatient.php");
            exit();
        } else {
            echo "Error deleting record: " . pg_last_error($con);
        }
    } else {
        echo "Invalid patient ID.";
    }
} else {
    echo "Patient ID not provided.";
}
?>
