N<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Search Patient</title>
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

            .container {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin: 20px auto;
                padding: 20px;
                max-width: 800px; 
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

            .delete-link {
                background-color: aqua;
                padding: 5px 10px;
                border-radius: 4px;
                color: #fff;
                text-decoration: none;
            }

            .delete-link:hover {
                background-color: #00cccc;
            }

        </style>
    </head>
    <body>
        <?php

        session_start();
        require('con_pg.php');

        if (isset($_POST['search_organ'])) {
            $organ = $_POST['organ'];

            if (!empty($organ)) {
                $organ = pg_escape_string($con, $organ);

                $query = "SELECT 
            d1.patient_id,
            d1.firstname AS patient_firstname,
            d1.lastname AS patient_lastname,
            d1.age AS patient_age,
            d1.gender,
            d1.email,
            d1.bloodtype,
            d1.medicalcondition,
            d1.pastsurgery,
            d1.address1,
            d1.address2,
            d1.address3,
            d2.organ,
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
            hospital d4 ON d3.hospital_id = d4.hospital_id
        WHERE 
            d2.organ = '$organ'";

                $result = pg_query($con, $query);

                if ($result) {
                    $rows = pg_num_rows($result);

                    if ($rows > 0) {

                        echo "<h2>Required patient for Organ: $organ</h2>";
                        echo "<table class='table'>";
                        echo "<tr>
                <th>Patient ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Blood Type</th>
                <th>Medical Condition</th>
                <th>Past Surgeries</th>
                <th>Address 1</th>
                <th>Address 2</th>
                <th>Address 3</th>
                <th>Organ</th>
                <th>Email</th>
                <th>Doctor ID</th>
                <th>Doctor First Name</th>
                <th>Doctor Last Name</th>
                <th>Speciality</th>
                <th>Hospital Name</th>
                <th>Action</th> <!-- Added delete action column -->
             </tr>";

                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>
                <td>{$row['patient_id']}</td>
                <td>{$row['patient_firstname']}</td>
                <td>{$row['patient_lastname']}</td>
                <td>{$row['patient_age']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['bloodtype']}</td>
                <td>{$row['medicalcondition']}</td>
                <td>{$row['pastsurgery']}</td>
                <td>{$row['address1']}</td>
                <td>{$row['address2']}</td>
                <td>{$row['address3']}</td>
                <td>{$row['organ']}</td>
                <td>{$row['email']}</td>
                <td>{$row['doctor_id']}</td>
                <td>{$row['doctor_firstname']}</td>
                <td>{$row['doctor_lastname']}</td>
                <td>{$row['department']}</td>
                <td>{$row['hospital_name']}</td>
                <td>
                    <a class='delete-link' href='deletepatient.php?id={$row['patient_id']}'>Delete</a>
                </td>
             </tr>";
                        }

                        echo "</table>";
                        echo "</div>";
                    } else {
                        echo "<div class='form'>
                      <h3>No patient found for organ: $organ.</h3><br/>
                      <p class='link'>Click here to <a href='searchpatient.php'>Search Again</a>.</p>
                      </div>";
                    }
                } else {
                    echo "Error in query: " . pg_last_error($con);
                }
            } else {
                echo "<div class='form'>
                      <h3>Please enter a valid organ name.</h3><br/>
                      <p class='link'>Click here to <a href='searchpatient.php'>Search Again</a>.</p>
                      </div>";
            }
        }
        ?>
 <div class="container">

            <form class="form" method="post" name="search" action="">

                <h1 class="title">Search patient by Organ</h1>
                <input type="text" class="input-field" name="organ" placeholder="Enter Organ Name"/><br>
                <input type="submit" value="Search" name="search_organ" class="submit-button"/>
            </form>
        </div>

    </body>
</html>
