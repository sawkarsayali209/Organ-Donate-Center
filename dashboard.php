<?php
require('con_pg.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Secured Page</title>
    <link rel="stylesheet" href="css/style.css"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .content {
            max-width: 1200px;
            margin: 0 auto;
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

        .header .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 10px;
        }

        .header .btn.logout-btn {
            background-color: #dc3545;
        }

        .header .btn:hover {
            background-color: #0056b3;
        }

        .main-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card{
              border: 1px solid rgba(0, 0, 0, 0)!important;

        }
        .summary {
            margin-bottom: 30px;
        }

        .summary-items {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .summary-item {
            flex-basis: calc(30% - 20px); /* Adjust according to your layout */
            margin-bottom: 20px;
        }

        .summary-item .card {
            background-color: #f2f2f2;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .summary-item h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .summary-item p {
            margin: 0;
            color: #777;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="header">
        <h1>Dashboard</h1>
        <div>
            <a href="index.php" class="btn">Home</a>
            <a href="logout.php" class="btn logout-btn">Logout</a>
        </div>
    </div>
    <div class="main-content">
        <div class="summary">
            <h2>Summary</h2>
            <div class="summary-items">
                <div class="summary-item">
                    <div class="card">
                        <h3>Total Donors</h3>
                        <?php
                        $sql = "SELECT COUNT(*) AS donor_count FROM donor1";
                        $result = pg_query($con, $sql);
                        if ($result) {
                            $row = pg_fetch_assoc($result);
                            $donorCount = $row['donor_count'];
                            echo "<p>Number of registered donors: $donorCount</p>";
                        } else {
                            echo "Error: Unable to fetch donor count";
                        }
                        ?>
                    </div>
                </div>
                <div class="summary-item">
                    <div class="card">
                        <h3>Total Patients</h3>
                        <?php
                        $sql = "SELECT COUNT(*) AS patient_count FROM patient";
                        $result = pg_query($con, $sql);
                        if ($result) {
                            $row = pg_fetch_assoc($result);
                            $patientCount = $row['patient_count'];
                            echo "<p>Number of registered patients: $patientCount</p>";
                        } else {
                            echo "Error: Unable to fetch patient count";
                        }
                        ?>
                    </div>
                </div>
                <div class="summary-item">
                    <div class="card">
                        <h3>Organs Availability</h3>
                        <?php
                        $sql = "SELECT COUNT(*) AS organs_count FROM organs";
                        $result = pg_query($con, $sql);
                        if ($result) {
                            $row = pg_fetch_assoc($result);
                            $organsCount = $row['organs_count'];
                            echo "<p>Number of registered donors who donate organs: $organsCount</p>";
                        } else {
                            echo "Error: Unable to fetch organ count";
                        }
                        ?>
                    </div>
                </div>
                <div class="summary-item">
                    <div class="card">
                        <h3>Organ Transplantation</h3>
                        <?php
                        $sql = "SELECT COUNT(*) AS transplant_count FROM transplants";
                        $result = pg_query($con, $sql);
                        if ($result) {
                            $row = pg_fetch_assoc($result);
                            $transplantCount = $row['transplant_count'];
                            echo "<p>Number of registered patients who receive organs: $transplantCount</p>";
                        } else {
                            echo "Error: Unable to fetch transplant count";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
