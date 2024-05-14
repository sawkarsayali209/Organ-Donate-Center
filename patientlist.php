<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Patient</title>
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

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        
        .form {
            text-align: center;
        }

        .title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .input-field {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .submit-button {
            width: calc(100% - 20px);
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }

        .link {
            color: #007bff;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
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
<body>

    <?php
    session_start();
    include 'con_pg.php';

    if (isset($_POST['email'])) {
        echo "Invalid email ";
        exit();
    }

    $query = "SELECT 
        d1.patient_id,
        d1.firstname AS patient_firstname,
        d1.lastname AS patient_lastname,
        d1.age ,
        d1.gender,
        d1.email,d1.pass,
        d1.bloodtype,
        d1.medicalcondition,
        d1.pastsurgery,d1.mobileno,
        d1.address1,
        d1.address2,
        d1.address3,
        d2.organ,d2.bill,d2.upi_id,
        d3.doctor_id,
        d3.firstname AS doctor_firstname,
        d3.lastname AS doctor_lastname,
        d3.department,
        d4.hospital_name

    FROM 
        patient d1
    INNER JOIN 
        organ_required d2 ON d1.patient_id=d2.patient_id
    INNER JOIN 
        doctor d3 ON d1.doctor_id = d3.doctor_id 
    INNER JOIN 
        hospital d4 ON d3.hospital_id = d4.hospital_id";

    $result = pg_query($con, $query) or die(pg_last_error($con));

    if (pg_num_rows($result) > 0) {
        echo "<h2>Patient Information</h2>";
        echo "<table>
                <tr>
                    <th>PATIENT_ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Blood Type</th>
                    <th>Medical Condition</th>
                    <th>Past surgeries</th>
                    <th>Mobile Number</th>
                    <th>Address1</th>
                    <th>Address2</th>
                    <th>Address3</th>
                    <th>Organs</th>
                                        <th>Paid Bill</th>

                    <th>UPI ID</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Doctor Id</th>
                    <th>Doctor Firstname</th>
                    <th>Doctor Lastname</th>
                    <th>Speciality</th>
                    <th>Hospital Name</th>
                 </tr>";

        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['patient_id']}</td>
                    <td>{$row['patient_firstname']}</td>
                    <td>{$row['patient_lastname']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['bloodtype']}</td>
                    <td>{$row['medicalcondition']}</td>
                    <td>{$row['pastsurgery']}</td>
                    <td>{$row['mobileno']}</td>
                    <td>{$row['address1']}</td>
                    <td>{$row['address2']}</td>
                    <td>{$row['address3']}</td>
                    <td>{$row['organ']}</td>
                     <td>{$row['bill']}</td>

                    <td>{$row['upi_id']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['pass']}</td>
                    <td>{$row['doctor_id']}</td>
                    <td>{$row['doctor_firstname']}</td>
                    <td>{$row['doctor_lastname']}</td>
                    <td>{$row['department']}</td>
                    <td>{$row['hospital_name']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No patient information available.";
    }

    pg_close($con);
    ?>
</div>
</body>
</html><!-- comment -->
