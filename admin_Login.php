<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'password123') {
        $_SESSION['admin'] = true;
        header('Location: admin.php');
        exit();
    } else {
        echo 'Invalid username or password';
    }
} else {
    echo 'Username and password are required';
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Login</title>
    </head>
    <style>

    </style>
    <body>
        <h2>Admin Login</h2>
        <div class="border1">
            <link rel="stylesheet" href="style.css"/>

            <form class="form" method="post"  action=" ">
                <h1 class="login-title">Login</h1>
                <input type="text" class="login-input" name="username" placeholder="Username/email" autofocus="true"/><br>
                <input type="password" class="login-input" name="password" placeholder="Password"/><br>
                <input type="submit" value="Login" name="submit" class="login-button"/>
            </form>
        </div>

    </form>
</body>
</html>
