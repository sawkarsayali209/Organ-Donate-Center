<?php
session_start();
include 'con_pg.php';
include "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $hospital_name= $_POST['hospital_name'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $query = "INSERT INTO hospital(hospital_name,city,state) VALUES ('$hospital_name', '$city', '$state')";
    $result = pg_query($con, $query) or die(pg_last_error($con));

    if ($result) {

        echo "<h1> Data added sucessesfully</h1>";
        exit; 

    } else {
        echo 'Error: ' . pg_last_error($con);
    }

    pg_close($con);
} else {
    echo "Invalid request or user not logged in.";
}
?>
<!doctype html>
<html
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            width: 500px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .textfield {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 style="color: red; font-size: 2.5rem;">Hospital Details</h1>
    <form action="" class="form-control" method="post">
       

        <div class="form-group">
            <label for="firstname">Hospital Name:</label>
            <input type="text" name="hospital_name" class="textfield" placeholder="Enter Hospital name" required>
        </div>
        <div class="form-group">
            <label for="lastname">city:</label>
            <input type="text" name="city" class="textfield" placeholder="Enter City name" required>
        </div>
                 <div class="form-group">
   <label for="state">State:</label>
            <input type="text" name="state" class="textfield" placeholder="state" required>
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</div><!-- comment -->
</body>
</html>
