<?php
session_start();
require('con_pg.php');

if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];

    if (!empty($doctor_id)) {
        $doctor_id = pg_escape_string($con, $doctor_id);

        $query = "DELETE FROM doctor WHERE doctor_id = '$doctor_id'";

        $result = pg_query($con, $query);

        if ($result) {
            header("Location: searchdoctor.php");
            exit();
        } else {
            echo "Error deleting record: " . pg_last_error($con);
        }
    } else {
        echo "Invalid Doctor ID.";
    }
} else {
    echo "Doctor ID not provided.";
}
?>
