<!doctype html>

<html>
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
        <?php
    function getPatient($con){
        $result = pg_query($con, "SELECT * FROM patient");
        return pg_fetch_all($result);
    }
    ?>

        <?php

include 'header.php';
session_start();
include 'con_pg.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $organ = $_POST['organ'];
           $bill = $_POST['bill'];
    $upi_id= $_POST['upi_id'];
    $upi_pin = $_POST['upi_pin'];


    $query = "INSERT INTO organ_required (patient_id, organ,bill,upi_id,upi_pin) VALUES ('$patient_id', '$organ','$bill','$upi_id','$upi_pin')";
    $result = pg_query($con, $query);

    if ($result) {
        echo "<h1>Thank you for Registration  data added successfully.</h1>";
                            echo '<script>alert("Thank you....!!");</script>';

        exit();

    } else {
        echo "Error: Failed to add organ requirement.";
        error_log('Error: ' . pg_last_error($con));
    }

    pg_close($con);
} else {
    echo "Invalid request or user not logged in.";
}
?>

           <div class="container">
        <h1 style="color: red; font-size: 2.5rem;"> organ Required Information </h1>

        <form action="" class="form-control" method="post">
                                        <div class="form-group">
                <label for="patient_id"> Patient :</label>
                <select name="patient_id" class="textfield" required>
                    <?php 
                    $patients= getPatient($con);
                    foreach($patients as $patient):?>
                        <option value="<?php echo $patient['patient_id']; ?>"><?php echo $patient['firstname'] . ' ' .$patient['lastname']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="oragn">Organ Required:</label>
                <input type="text" name="organ" class="textfield" placeholder="Enter organ name" required>
            </div>
                        <div class="form-group">
                <label for="bill">Paid Bills:</label>
                <select id="bill" name="bill" class="textfield" required>
                    <option value="1000000">For Heart-10 lakh</option>
                    <option value="2000000">For eye-20 lakh</option>
                    <option value="1500000">For liver-15lakh</option>
                                        <option value="5lakh">For kidney-5lakh</option>
                    <option value="1500000">For pancreas-15lakh</option>
                    <option value="1500000">For Cornea-15lakh</option>
                                        <option value="500000">For Lungs-5lakh</option>

                    <option value="1000000">For Bone Marrow-10lakh</option>


                </select>
            </div>

           
            <div class="form-group">
                <label for="upi_id">UPI ID:</label>
                <input type="text" name="upi_id" class="textfield" placeholder="Enter UPI ID" required>
            </div>
           
            <div class="form-group">
                <label for="upi_pin">UPI PIN:</label>
                <input type="password" name="upi_pin" class="textfield" placeholder="Enter UPI PIN" required>
            </div>
           

           
            <div class="form-group">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
        </div><!-- comment -->
    </body>
</html>

        