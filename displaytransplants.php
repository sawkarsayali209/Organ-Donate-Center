<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Transplants details</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .table-wrapper {
            max-height: 500px; 
            overflow-y: auto; 
        }
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

.table th {
    background-color: #f2f2f2;


</style>
<?php
session_start();
include 'header.php';
include 'con_pg.php';

$query="SELECT 
    d1.patient_id,
    d1.date,d1.status,
    d2.patient_id,
    d3.organ_id,
    d3.organ
FROM 
  transplants d1
INNER JOIN 
    patient d2 ON d1.patient_id=d2.patient_id
INNER JOIN 
   organs d3 ON d1.organ_id = d3.organ_id ";
$result = pg_query($con, $query) or die(pg_last_error($con));

if (pg_num_rows($result) > 0) {
    echo "<h2>Patient Information</h2>";
    echo "<table border>
            <tr>
                <th>Patient_ID</th>
                <th>Date of Transplantation</th>
                <th>Organ Id</th>
                <th>organ</th>
                <th>Status</th>
                
             </tr>";
              
    while ($row = pg_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['patient_id']}</td>
                <td>{$row['date']}</td>
                <td>{$row['organ_id']}</td>
                <td>{$row['organ']}</td>
                                <td>{$row['status']}</td>

              </tr>";
     }

    echo "</table>";
} else {
    echo "No patient information available.";
}

// Close the database connection
pg_close($con);
?>
