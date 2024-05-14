<?php
session_start();
include 'con_pg.php'; // Include database connection

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_Login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit();
}

$donorId = $_GET['id']; // Corrected variable name

$query = "SELECT * FROM organs WHERE donor_id = '$donorId'";
$result = pg_query($con, $query);
$available = pg_fetch_assoc($result);

if (!$available) {
    header('Location: admin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newDonorId = $_POST['donor_id'];
    $newOrgan = $_POST['organ'];
    $newStatus = $_POST['status']; // Corrected variable name

    $updateQuery = "UPDATE organs SET donor_id = '$newDonorId', organ = '$newOrgan', status = '$newStatus' WHERE donor_id = '$donorId'";
    $updateResult = pg_query($con, $updateQuery);

    if ($updateResult) {
        header('Location: admin.php');
        exit();
    } else {
        $errorMessage = "Failed to update organ Availability.";
    }
}

pg_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Organ Availability</title>
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
            <h2>Update Organ Availability</h2>
            <?php if (isset($errorMessage)): ?>
                <p style="color: red;"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label for="donor_id">Donor ID:</label>
                    <input type="text" id="donor_id" name="donor_id" value="<?php echo $available['donor_id']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="organ">Organ:</label>
                    <input type="text" id="organ" name="organ" value="<?php echo $available['organ']; ?>">
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" id="status" name="status" value="<?php echo $available['status']; ?>">
                </div>

               
                <div class="form-group">
                    <button type="submit">Update </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
