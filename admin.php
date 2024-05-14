<?php
session_start();
include 'con_pg.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_Login.php');
    exit();
}

function getOrganRequirements($con) {
    $query = "SELECT * FROM organ_required";
    $result = pg_query($con, $query);
    return pg_fetch_all($result);
}
function getOrganAvailable($con) {
    $query = "SELECT * FROM organs";
    $result = pg_query($con, $query);
    return pg_fetch_all($result);
}



$donorCount = pg_fetch_assoc(pg_query($con, "SELECT COUNT(*) AS donor_count FROM donor1"))['donor_count'];
$patientCount = pg_fetch_assoc(pg_query($con, "SELECT COUNT(*) AS patient_count FROM patient"))['patient_count'];
$organsCount = pg_fetch_assoc(pg_query($con, "SELECT COUNT(*) AS organs_count FROM organs"))['organs_count'];
$transplantCount = pg_fetch_assoc(pg_query($con, "SELECT COUNT(*) AS transplant_count FROM transplants"))['transplant_count'];

$organRequirements = getOrganRequirements($con);
$organavailable = getOrganAvailable($con);

// Close database connection
pg_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organ Donation System Dashboard</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 20px;
        }
        .sidebar {
            flex: 0 0 20%;
            background-color: #333;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
        }
        .sidebar h2 {
            color: whitesmoke;
            margin-bottom: 20px;
            text-align: center;
        }
        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px 0;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #444;
            border-radius: 5px;
        }

        .dashboard {
            flex: 0 0 80%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #333;
            margin: 0;
        }
        .logout-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #0056b3;
        }
        .summary {
            margin-bottom: 30px;
            background-color: #f2f2f2;
            border-radius: 10px;
            padding: 20px;
            margin: 0 auto;
        }
        .summary h2 {
            margin-bottom: 10px;
            color: #333;
        }
        .summary-items {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .summary-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            flex-basis: calc(50% - 20px);
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .summary-item h3 {
            margin-bottom: 10px;
            color: #333;
        }
        .summary-item p {
            color: #777;
            margin: 0;
        }

        .organ-requirements {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .organ-requirements table {
            width: 100%;
            border-collapse: collapse;
        }
        .organ-requirements th, .organ-requirements td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .organ-requirements th {
            background-color: #f2f2f2;
        }
        .organ-requirements tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .organ-requirements tr:hover {
            background-color: #ddd;
        }
        .action-btn {
            display: inline-block;
            padding: 6px 12px;
            margin-right: 5px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
        }
        .action-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
            <div class="container">

        <div class="sidebar">
            <h2>WELCOME TO ADMIN</h2>
            <a href="dashboard.php"> <h2> DashBoard</h2>
            <a href="donorlist.php"> <h2> Donor Details</h2>
                <a href="patientlist.php"> <h2> Patient Details</h2>
                                    <a href="searchdonor.php"> <h2>Search Donor</h2>
                <a href="searchpatient.php"> <h2> Search Patient</h2>
                <a href="add_Hospital.php"> <h2> Add Hospitals Details</h2>
                <a href="add_doctor.php"> <h2> Add Doctors Details</h2>

            <a href="add_transplants.php"> <h2>Transplantation Process</h2>
                <a href="searchhospital.php"><h2>Search Hospital</h2>
                                    <a href="searchdoctor.php"><h2>Search Doctor</h2>

        </div>


        <div class="dashboard">
            <div class="header">
                <h1>Dashboard</h1>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
            <div class="summary">
                <h2>Summary</h2>
                <div class="summary-items">
                    <div class="summary-item">
                        <h3>Total Donor</h3>
                        <p><?php echo $donorCount; ?></p>
                    </div>
                    <div class="summary-item">
                        <h3>Total Patient</h3>
                        <p><?php echo $patientCount; ?></p>
                    </div>
                    <div class="summary-item">
                        <h3>Organ Availability</h3>
                        <p><?php echo $organsCount; ?></p>
                    </div>
                    <div class="summary-item">
                        <h3>Organ Transplantation</h3>
                        <p><?php echo $transplantCount; ?></p>
                    </div>
                </div>
            </div>
            <div class="organ-requirements">
                <h2>Organ Requirements</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Organ</th>
                            <th>UPI ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($organRequirements as $requirement): ?>
                            <tr>
                                <td><?php echo $requirement['patient_id']; ?></td>
                                <td><?php echo $requirement['organ']; ?></td>
                                <td><?php echo $requirement['upi_id']; ?></td>
                                <td>
                                    <a href="updateorganrequired.php?id=<?php echo $requirement['patient_id']; ?>" class="action-btn">Update</a>
                                    <a href="deletepatient.php?id=<?php echo $requirement['patient_id']; ?>" class="action-btn" onclick="return confirm('Are you sure you want to delete this requirement?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
             <div class="organ-requirements">
                <h2>Organ Donated By Donor</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Donor ID</th>
                            <th>Organ</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($organavailable as $available): ?>
                            <tr>
                                <td><?php echo $available['donor_id']; ?></td>
                                <td><?php echo $available['organ']; ?></td>
                                <td><?php echo $available['status']; ?></td>
                                <td>
                                    <a href="update_oragn_availability.php?id=<?php echo $available['donor_id']; ?>" class="action-btn">Update</a>
                                    <a href="deletedonor.php?id=<?php echo $available['donor_id']; ?>" class="action-btn" onclick="return confirm('Are you sure you want to delete this requirement?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>
