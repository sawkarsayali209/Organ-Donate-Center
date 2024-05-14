<?php
session_start();
include 'con_pg.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_Login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit();
}

$patientId = $_GET['id'];

$query = "SELECT * FROM organ_required WHERE patient_id = '$patientId'";
$result = pg_query($con, $query);
$requirement = pg_fetch_assoc($result);

if (!$requirement) {
    header('Location: admin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPatientId = $_POST['patient_id'];
    $newOrgan = $_POST['organ'];
    $newUpiId = $_POST['upi_id'];

    $updateQuery = "UPDATE organ_required SET patient_id = '$newPatientId', organ = '$newOrgan', upi_id = '$newUpiId' WHERE patient_id = '$patientId'";
    $updateResult = pg_query($con, $updateQuery);

    if ($updateResult) {
        header('Location: admin.php');
        exit();
    } else {
        $errorMessage = "Failed to update requirement.";
    }
}

// Close database connection
pg_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Organ Requirement</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            max-width: 600px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Update Organ Requirement</h2>
            <?php if (isset($errorMessage)): ?>
                <p style="color: red;"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label for="patient_id">Patient ID:</label>
                    <input type="text" id="patient_id" name="patient_id" value="<?php echo $requirement['patient_id']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="organ">Organ:</label>
                    <input type="text" id="organ" name="organ" value="<?php echo $requirement['organ']; ?>">
                </div>
                <div class="form-group">
                    <label for="upi_id">UPI ID:</label>
                    <input type="text" id="upi_id" name="upi_id" value="<?php echo $requirement['upi_id']; ?>">
                </div>
                <div class="form-group">
                    <button type="submit">Update Requirement</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
