<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();

    include 'con_pg.php'; 
    include "header.php";

    function getHospitalData($con) {
        $query = "SELECT * FROM hospital";
        $result = pg_query($con, $query);
        $hospitalData = array();
        while ($row = pg_fetch_assoc($result)) {
            $hospitalData[] = $row;
        }
        return $hospitalData;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $department = $_POST['department'];
        $hospital_id = $_POST['hospital_id'];
        $mobileno = $_POST['mobileno'];

        $firstname = pg_escape_string($con, $firstname);
        $lastname = pg_escape_string($con, $lastname);
        $department = pg_escape_string($con, $department);
        $hospital_id = pg_escape_string($con, $hospital_id);
        $mobileno = pg_escape_string($con, $mobileno);

        $query = "INSERT INTO doctor (firstname, lastname, department, hospital_id, mobileno) 
                  VALUES ('$firstname', '$lastname', '$department', '$hospital_id', '$mobileno')";
        
        $result = pg_query($con, $query);

        if ($result) {
            echo "<h1>Data added sucessfully</h1>";
            exit(); 
        } else {
            echo 'Error: ' . pg_last_error($con);
        }
        
        pg_close($con);
    } else {
        echo "Invalid request or user not logged in.";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Details</title>
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
        <h1 style="color: red; font-size: 2.5rem;">Doctor Details</h1>
        <form action="" class="form-control" method="post">
            <div class="form-group">
                <label for="firstname">Enter First Name:</label>
                <input type="text" name="firstname" class="textfield" placeholder="Enter First name" required>
            </div>
            <div class="form-group">
                <label for="lastname">Enter Last Name:</label>
                <input type="text" name="lastname" class="textfield" placeholder="Enter Last name" required>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" name="department" class="textfield" placeholder="Department" required>
            </div>
            <div class="form-group">
                <label for="hospital_id"> Choose Hospital:</label>
                <select name="hospital_id" class="textfield" required>
                    <?php 
                        $hospitalData = getHospitalData($con);
                        foreach($hospitalData as $hospital):
                    ?>
                        <option value="<?php echo $hospital['hospital_id']; ?>"><?php echo $hospital['hospital_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="mobileno">Mobile Number:</label>
                <input type="tel" name="mobileno" class="textfield" placeholder="Enter mobile no" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
