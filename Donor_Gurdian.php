<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Guardian</title>
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


<?php 
include 'header.php';
include 'con_pg.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $donor_id = isset($_POST['donor_id'])? $_POST['donor_id'] : '';

    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $Relation = isset($_POST['relation']) ? $_POST['relation'] : '';
    $address1 = isset($_POST['state']) ? $_POST['state'] : '';
    $address2 = isset($_POST['city']) ? $_POST['city'] : '';
    $address3 = isset($_POST['street']) ? $_POST['street'] : '';

    // Escape special characters in the values
    $donor_id = pg_escape_string($donor_id);
    $firstname = pg_escape_string($firstname);
    $lastname = pg_escape_string($lastname);
    $Relation = pg_escape_string($Relation);
    $address1 = pg_escape_string($address1);
    $address2 = pg_escape_string($address2);
    $address3 = pg_escape_string($address3);

    $query = "INSERT INTO Relation (donor_id,firstname, lastname, relative, state, city, street) 
              VALUES   ('$donor_id','$firstname', '$lastname', '$Relation', '$address1', '$address2', '$address3')";
    $result = pg_query($con, $query);

    if ($result) {
       echo'<h1>Donor Registered Successfully</h1>';
                   echo '<script>alert("Thank you....!!");</script>';

        exit();

    } else {
        echo "Error: ".pg_last_error($con);
    }
    pg_close($con);
} else {
    echo "Invalid request.";
}
?>
            <?php
    function getDonor($con){
        $result = pg_query($con, "SELECT * FROM donor1");
        return pg_fetch_all($result);
    }
    ?>

<div class="container">
    <h1 style="color: red; font-size: 2.5rem;">Relation with Donor</h1>
    <form action="" class="form-control" method="post">
                <div class="form-group">
            <label for="donor_id"> Donor :</label>
                <select name="donor_id" class="textfield" required>
                    <?php 
                    $donors= getDonor($con);
                    foreach($donors as $donor):?>
                        <option value="<?php echo $donor['donor_id']; ?>"><?php echo $donor['firstname'] . ' ' .$donor['lastname']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


                <div class="form-group">
            <label for="firstname">Enter First Name:</label>
            <input type="text" name="firstname" class="textfield" placeholder="Enter First Name" required>
        </div>
        <div class="form-group">
            <label for="lastname">Enter Last Name:</label>
            <input type="text" name="lastname" class="textfield" placeholder="Enter Last Name" required>
        </div>
        <div class="form-group">
            <label for="relation">Relation:</label>
            <input type="text" name="relation" class="textfield" placeholder="Enter Relation" required>
        </div>
        <div class="form-group">
            <label for="state">State:</label>
            <input type="text" name="state" class="textfield" placeholder="Enter State" required>
        </div>
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" name="city" class="textfield" placeholder="Enter City" required>
        </div>
        <div class="form-group">
            <label for="street">Street:</label>
            <input type="text" name="street" class="textfield" placeholder="Enter Street" required>
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</div>
</body>
</html>
