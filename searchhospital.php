<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Search Hospital</title>
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

if (isset($_POST['hospital_name'])) {
    $hospital_name = $_POST['hospital_name'];

    if (!empty($hospital_name)) {
        $hospital_name = pg_escape_string($con, $hospital_name);

        $query = "SELECT 
                        d1.hospital_id,
                        d1.hospital_name,
                        d1.city,
                        d1.state
                    FROM 
                        hospital d1
                    WHERE 
                        d1.hospital_name ILIKE '%$hospital_name%'";

        $result = pg_query($con, $query) or die(pg_last_error($con));

        if (pg_num_rows($result) > 0) {
            echo "<div class='container'>";
            echo "<h2>Hospital Information</h2>";
            echo "<div class='table-wrapper'>";
            echo "<table class='table'>";
            echo "<tr>
                    <th>Hospital Id</th>
                    <th>Hospital Name</th>
                    <th>City</th>
                    <th>State</th>
                                        <th>Action</th>

                    
                 </tr>";

            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['hospital_id']}</td>
                        <td>{$row['hospital_name']}</td>
                        <td>{$row['city']}</td>
                        <td>{$row['state']}</td>
               <td><a class='delete-link' href='deletehospital.php?id={$row['hospital_id']}'>Delete</a></td>

                     </tr>";
            }

            echo "</table>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<div class='form'>
                      <h3>No Hospital Found: $hospital_name</h3><br/>
                      <p class='link'>Click here to <a href='searchhospital.php'>Search Again</a>.</p>
                      </div>";
        }
    } else {
        echo "<div class='form'>
                      <h3>Please enter a valid hospital name.</h3><br/>
                      <p class='link'>Click here to <a href='searchhospital.php'>Search Again</a>.</p>
                      </div>";
    }
}
?>
<div class="container">
    <form class="form" method="post" name="search" action="">
        <h1 class="title">Search Hospital</h1>
        <input type="text" class="input-field" name="hospital_name" placeholder="Enter Hospital Name"/><br>
        <input type="submit" value="Search" name="search_hospital" class="submit-button"/>
    </form>
</div>
</body>
</html>
