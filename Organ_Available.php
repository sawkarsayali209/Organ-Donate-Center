<?php
session_start();
include "header.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'con_pg.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $organ = isset($_POST['organ']) ? pg_escape_string($_POST['organ']) : '';
    $status = isset($_POST['status']) ? pg_escape_string($_POST['status']) : '';
    $donor_id = isset($_POST['donor_id']) ? pg_escape_string($_POST['donor_id']) : '';

    if (!empty($organ) && !empty($status) && !empty($donor_id)) {
        $query = "INSERT INTO organs (organ, status, donor_id) VALUES ('$organ', '$status', '$donor_id')";
        $result = pg_query($con, $query);

        if ($result) {
            pg_close($con);
            header('Location: Donor_Gurdian.php');
            exit;
        } else {
            echo 'Error: Failed to insert data into the database.';
            error_log('Error: ' . pg_last_error($con));
        }
    } else {
        echo 'Error: Please fill in all required fields.';
    }
} else {
    echo 'Invalid request.';
}
?>
 <?php
    function getDonor($con){
        $result = pg_query($con, "SELECT * FROM donor1");
        return pg_fetch_all($result);
    }
?>
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
<div class="container">
    <h1 style="color: red; font-size: 2.5rem;">Organ Donation Information</h1>
    <form action="" class="form-control" method="post">
        <div class="form-group">
            <label for="oragn">Organ:</label>
            <input type="text" name="organ" class="textfield" placeholder="Enter organ name" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" name="status" class="textfield" placeholder="Status" required>
        </div>
        <div class="form-group">
            <label for="donor_id">Donor:</label>
            <select name="donor_id" class="textfield" required>
                <?php
                $donors = getDonor($con);
                foreach ($donors as $donor): ?>
                    <option value="<?php echo $donor['donor_id']; ?>"><?php echo $donor['firstname'] . ' ' . $donor['lastname']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</div>
</body>
</html>
