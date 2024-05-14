<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transplantation</title>
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
    <?php include 'header.php'; 
?>
     <?php
    function getPatient($con){
        $result = pg_query($con, "SELECT * FROM patient");
        return pg_fetch_all($result);
    }
    ?>
<?php
    function getOrgans($con){
        $result = pg_query($con, "SELECT * FROM organs");
        return pg_fetch_all($result);
    }
    ?>


    <?php
    session_start();
    include 'con_pg.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patient_id = $_POST['patient_id'];
        $organ_id = $_POST['organ_id'];
        $date = $_POST['date'];
        $status= $_POST['status'];


        $query = "INSERT INTO transplants(patient_id, organ_id, date, status) VALUES ('$patient_id', '$organ_id', '$date', '$status')";
        $result = pg_query($con, $query);

        if ($result) {
            echo "<h1>Transplantation details added successfully</h1>";
        } else {
            echo 'Error: Failed to add transplantation details. Please try again.';
        }

        pg_close($con);
    }
    ?>

    <div class="container">
        <h1 style="color: red; font-size: 2.5rem;">Add Transplantation Details</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-control" method="post">
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
                <label for="organ_id"> Organs :</label>
                <select name="organ_id" class="textfield" required>
                    <?php 
                    $organs= getOrgans($con);
                    foreach($organs as $organ):?>
                        <option value="<?php echo $organ['organ_id']; ?>"><?php echo $organ['organ']; ?></option>
                    <?php endforeach; ?>
                </select>

                       <div class="form-group">
                <label for="date">Enter Date:</label>
                <input type="date" name="date" class="textfield" placeholder="Enter date" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" name="status" class="textfield" placeholder="Status" required>
            </div>

            <div class="form-group">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
