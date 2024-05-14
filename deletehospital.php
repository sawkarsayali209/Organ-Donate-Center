<?php
session_start();
require('con_pg.php');

if (isset($_GET['id'])) {
    $hospital_id = $_GET['id'];

    if (!empty($hospital_id)) {
        $hospital_id = pg_escape_string($con, $hospital_id);

        $query = "DELETE FROM hospital WHERE hospital_id = '$hospital_id'";

        $result = pg_query($con, $query);

        if ($result) {
            header("Location: searchhospital.php");
            exit();
        } else {
            echo "Error deleting record: " . pg_last_error($con);
        }
    } else {
        echo "Invalid Hospital ID.";
    }
} else {
    echo "Hospital ID not provided.";
}
?>
