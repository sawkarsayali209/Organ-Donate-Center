<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<?php
include 'con_pg.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donor_id = isset($_POST['number']) ? $_POST['number'] : '';
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $lastname = isset($_POST['lastname']) ? $_POST['lastname']: '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $bloodtype = isset($_POST['bloodtype']) ? $_POST['bloodtype'] : '';
    $mobileno = isset($_POST['mobileno']) ? $_POST['mobileno'] : '';
   $doctor_id = isset($_POST['doctor_id']) ? $_POST['doctor_id'] : '';
    $address1 = isset($_POST['address1']) ? $_POST['address1'] : '';
    $address2 = isset($_POST['address2']) ? $_POST['address2'] : '';
    $address3 = isset($_POST['address3']) ? $_POST['address3'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $medicalcondition = isset($_POST['medicalcondition']) ? $_POST['medicalcondition'] : '';
    $pastsurgery = isset($_POST['pastsurgery']) ? $_POST['pastsurgery'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $signature_data = isset($_POST['signature']) ? $_POST['signature'] : '';
    $query = "INSERT INTO donor1 (firstname, lastname, age, gender, bloodtype, mobileno, doctor_id, address1, address2, address3, email, medicalcondition, pastsurgery, pass, signature) 
              VALUES ('$firstname', '$lastname', '$age', '$gender', '$bloodtype', '$mobileno', '$doctor_id', '$address1', '$address2', '$address3', '$email', '$medicalcondition', '$pastsurgery', '$pass', '$signature_data')";

    $result = pg_query($query);

    if ($result) {
        header("Location: success.php");
        exit();
        
    } else {
        echo "Error: ".pg_last_error($con);
    }
    

    pg_close($con);
} else {
    echo "Invalid request.";
}
?>







