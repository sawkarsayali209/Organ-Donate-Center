<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh;
        }
        .container {
            align-items: center; 
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: auto; 
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            font-weight: bold;
            margin-bottom: 10px;
        }
        select, input[type="submit"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php 
session_start();

if(isset($_SESSION['email'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_role = $_POST['user_role'];
    
    if ($user_role == "donor") {
        header("Location: donor_login.php");
        exit();
    } elseif ($user_role == "patient") {
        header("Location: patient_login.php");
        exit();
    } elseif ($user_role == "admin") {
        header("Location: admin_Login.php");
        exit();
    }
}
?>
<?php include 'header.php';
?>
<div class="container">
    <h2>Login</h2>
    <form method="post" action="login.php">
        <label for="user_role">Select User Role:</label>
        <select name="user_role" id="user_role">
            <option value="donor">Donor</option>
            <option value="patient">Patient</option>
            <option value="admin">Admin</option>
        </select>
        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>
