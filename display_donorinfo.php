<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Donors</title>
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
}

    </style>
</head>

<?php
include 'header.php';
session_start();
include 'con_pg.php';

if (isset($_POST['email'])) {
    echo "Invalid email ";
    exit();
}

$query="SELECT 
    d1.donor_id,
    d1.firstname AS donor_firstname,
    d1.lastname AS donor_lastname,
    d1.age AS donor_age,
    d1.gender,
    d1.email,
    d1.bloodtype,
    d1.medicalcondition,
    d1.pastsurgery,
    d1.address1,
    d1.address2,
    d1.address3,
    d2.organ, d2.status,
    d3.doctor_id,
    d3.firstname AS doctor_firstname,
    d3.lastname AS doctor_lastname,
    d3.department,
    d4.hospital_name,d5.relative,d5.firstname AS relative_name
    
FROM 
    donor1 d1
INNER JOIN 
    organs d2 ON d1.donor_id=d2.donor_id
INNER JOIN 
    doctor d3 ON d1.doctor_id = d3.doctor_id 
INNER JOIN 
    hospital d4 ON d3.hospital_id = d4.hospital_id
        INNER JOIN 
    relation d5 ON d1.donor_id = d5.donor_id";





$result = pg_query($con, $query) or die(pg_last_error($con));

if (pg_num_rows($result) > 0) {
     echo "<h2>Donor Information</h2>";
    echo "<table>
            <tr>
                <th>Donor_ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Blood Type</th>
                <th>Medical Condition</th>
                <th>Past surgeries</th>
                <th>Address1</th>
                <th>Address2</th>
                <th>Address3</th>
                <th>Organs</th>
                <th>Organ Status</th>
                <th>Email</th>
                 <th>Relative firstname</th>
                <th>Relation</th>

                <th>Doctor Id</th>
                <th>Doctor Firstname</th>
                <th>Doctor Lastname</th>
                <th>Speciality</th>
                <th>Hospital Name</th>
             </tr>";
              
    // Output data of each row
    while ($row = pg_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['donor_id']}</td>
                <td>{$row['donor_firstname']}</td>
                <td>{$row['donor_lastname']}</td>
                <td>{$row['age']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['bloodtype']}</td>
                <td>{$row['medicalcondition']}</td>
                <td>{$row['pastsurgery']}</td>
                <td>{$row['address1']}</td>
                <td>{$row['address2']}</td>
                <td>{$row['address3']}</td>
                <td>{$row['organ']}</td>
                                    <td>{$row['status']}</td>

                <td>{$row['email']}</td>
                                    <td>{$row['relative_name']}</td>
                <td>{$row['relative']}</td>

                <td>{$row['doctor_id']}</td>
                <td>{$row['doctor_firstname']}</td>
                <td>{$row['doctor_lastname']}</td>
                <td>{$row['department']}</td>
                <td>{$row['hospital_name']}</td>
              </tr>";
     }


    echo "</table>";
} else {
    echo "No donor information available.";
}

// Close the database connection
pg_close($con);
?>
</html><!-- comment -->
</body>