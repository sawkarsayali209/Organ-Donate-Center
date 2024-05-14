<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
    include "header.php";
    session_start();
    require('con_pg.php');

    if (isset($_POST['email']) && isset($_POST['pass'])) {
        $email = pg_escape_string($con, $_POST['email']);
        $pass = pg_escape_string($con, $_POST['pass']);

        $query = "SELECT * FROM patient WHERE email=$1 AND pass=$2";
        $result = pg_prepare($con, "login_query", $query); 

        if ($result) { 
            $result = pg_execute($con, "login_query", array($email, $pass)); 

            if ($result) {
                $rows = pg_num_rows($result);

                if ($rows > 0) {
                    $_SESSION['email'] = $email;  
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<div class='form'>
                          <h3>Incorrect Username/password.</h3><br/>
                          <p class='link'>Click here to <a href='patient_login.php'>Login</a> again.</p>
                          </div>";
                }
            } else {
                echo "Error in query: " . pg_last_error($con);
            }
        } else {
            echo "Error preparing statement: " . pg_last_error($con);
        }
    } else {
        echo "<div class='form'>
              <h3>Email or password not provided.</h3><br/>
              <p class='link'>Click here to <a href='patient_login.php'>Login</a> again.</p>
              </div>";
    }
    ?>

    <div class="border1">
        <form class="form" method="post" name="login" action="patient_login.php">
            <h1 class="login-title">Patient Login</h1>
            <input type="text" class="login-input" name="email" placeholder="Username/email" autofocus="true"/><br>
            <input type="password" class="login-input" name="pass" placeholder="Password"/><br>
            <input type="submit" value="Login" name="submit" class="login-button"/>
            <p>Don't have an account? <a href='add_patient.php'>Register Now</a></p>
        </form>
    </div>
    <?php 
$_SESSION['patient_id'] = $patient_id;
?>


</body>
</html>
