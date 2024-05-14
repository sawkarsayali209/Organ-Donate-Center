
<?php
session_start();
include 'con_pg.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $patient_id = $_POST['patient_id'];

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $bloodtype = $_POST['bloodtype'];
    $mobileno = $_POST['mobileno'];
        $doctor_id = $_POST['doctor_id'];

    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $address3 = $_POST['address3'];
    $email = $_POST['email'];
    $medicalcondition = $_POST['medicalcondition'];
    $pastsurgery = $_POST['pastsurgery'];
    $pass = $_POST['pass'];

    



    $query = "INSERT INTO patient(firstname, lastname, age, gender, bloodtype, mobileno,doctor_id ,address1, address2, address3, email, medicalcondition, pastsurgery, pass) VALUES ('$firstname', '$lastname', '$age', '$gender', '$bloodtype', '$mobileno','$doctor_id','$address1', '$address2', '$address3', '$email', '$medicalcondition', '$pastsurgery', '$pass')";

    $result = pg_query($con, $query) or die(pg_last_error($con));

    if ($result) {
        
        echo "Patient registered successfully";
      header("Location:sucesspatient.php");
    } else {
        echo 'Error: ' . pg_last_error($con);
    }

    pg_close($con);
} else {
    echo "Invalid request or user not logged in.";
}
?>
