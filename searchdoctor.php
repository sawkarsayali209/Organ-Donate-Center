<?php
session_start();
require('con_pg.php');

if (isset($_POST['department'])) {
    $department = $_POST['department'];

    if (!empty($department)) {
        $department = pg_escape_string($con, $department);

        $query = "SELECT 
                        d1.doctor_id,
                        d1.firstname,
                        d1.lastname,
                        d1.department,
                        d1.mobileno
                    FROM 
                       doctor d1
                    WHERE 
                        d1.department ILIKE '%$department%'";

        $result = pg_query($con, $query) or die(pg_last_error($con));

        if (pg_num_rows($result) > 0) {
            echo "<div class='container'>";
            echo "<h2>Doctor Information</h2>";
            echo "<div class='table-wrapper'>";
            echo "<table class='table'>";
            echo "<tr>
                    <th>Doctor ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Department</th>
                    <th>Mobile No</th>
                    <th>Action</th>
                 </tr>";

            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['doctor_id']}</td>
                        <td>{$row['firstname']}</td>
                        <td>{$row['lastname']}</td>
                        <td>{$row['department']}</td>
                        <td>{$row['mobileno']}</td>
                        <td><a class='delete-link' href='deletedoctor.php?id={$row['doctor_id']}'>Delete</a></td>
                     </tr>";
            }

            echo "</table>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<div class='form'>
                      <h3>No Doctor Found in $department department.</h3><br/>
                      <p class='link'>Click here to <a href='searchdoctor.php'>Search Again</a>.</p>
                      </div>";
        }
    } else {
        echo "<div class='form'>
                      <h3>Please enter a valid department.</h3><br/>
                      <p class='link'>Click here to <a href='searchdoctor.php'>Search Again</a>.</p>
                      </div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Search Doctor by Department</title>
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
<div class="container">
    <form class="form" method="post" name="search" action="">
        <h1 class="title">Search Doctor by Department</h1>
        <input type="text" class="input-field" name="department" placeholder="Enter Department"/><br>
        <input type="submit" value="Search" name="search_doctor" class="submit-button"/>
    </form>
</div>
</body>
</html>
