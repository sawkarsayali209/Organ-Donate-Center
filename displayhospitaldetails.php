<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Hospital details</title>
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

        .table-wrapper {
            max-height: 500px; 
            overflow-y: auto; 
        }
    </style>
</head>
<body>
    <?php
    include 'header.php';
    session_start();
    include 'con_pg.php';

    $query="SELECT 
        d1.hospital_id,
        d1.hospital_name ,
        d2.doctor_id,
        d2.firstname,
        d2.lastname,
        d2.department,
        d2.mobileno
    FROM 
        hospital d1
    INNER JOIN 
        doctor d2 ON d1.hospital_id=d2.hospital_id";

    $result = pg_query($con, $query) or die(pg_last_error($con));

    if (pg_num_rows($result) > 0) {
        echo "<h2>Hospital Information</h2>";
        echo "<div class='table-wrapper'>";
        echo "<table border='1'>
                <tr>
                    <th>Hospital Id</th>
                    <th>Hospital name</th>
                    <th>Doctor Id</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Department</th>
                    <th>Mobile Number</th>
                 </tr>";
                  
        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['hospital_id']}</td>
                    <td>{$row['hospital_name']}</td>
                    <td>{$row['doctor_id']}</td>
                    <td>{$row['firstname']}</td>
                    <td>{$row['lastname']}</td>
                    <td>{$row['department']}</td>
                    <td>{$row['mobileno']}</td>
                  </tr>";
         }
        echo "</table>";
        echo "</div>";
    } else {
        echo "No Hospital information available.";
    }

    pg_close($con);
    ?>
</body>
</html>
