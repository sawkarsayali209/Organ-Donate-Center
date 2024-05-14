<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration Form</title>
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
        }
        .form-group {
            margin-bottom: 20px;
            display: inline-block;
            width: 45%;
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
        .submit-btn-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    function getDoctor($con){
        $result = pg_query($con, "SELECT * FROM doctor");
        return pg_fetch_all($result);
    }
?>
    <?php include 'header.php';?>
    <?php include 'con_pg.php'; ?>
      

    <div class="container">
        <img src="image/img2.jpeg" height="52" width="52">
        <h1 style="color: red; font-size: 2.5rem;">Donor Registration Form</h1>

        <form action="donor_data1.php" class="form-control" method="post">
            <div>
                <div class="form-group">
                    <label for="firstname">Enter First Name:</label>
                    <input type="text" name="firstname" class="textfield" placeholder="Enter First name" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Enter Last Name:</label>
                    <input type="text" name="lastname" class="textfield" placeholder="Enter Last name" required>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" name="age" class="textfield" placeholder="Age" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" class="textfield" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="bloodtype">Blood Type:</label>
                    <input type="text" name="bloodtype" class="textfield" placeholder="Blood Type" required>
                </div>
                <div class="form-group">
                    <label for="mobileno">Mobile Number:</label>
                    <input type="tel" name="mobileno" class="textfield" placeholder="Mobile Number" required>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="doctor_id"> Choose Doctor :</label>
                    <select name="doctor_id" class="textfield" required>
                        <?php 
                        $doctors = getDoctor($con);
                        foreach($doctors as $doctor):?>
                            <option value="<?php echo $doctor['doctor_id']; ?>"><?php echo'Dr.'. $doctor['firstname'] . ' ' .$doctor['lastname']. ' a '.$doctor['department']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address1">Address 1:</label>
                    <input type="text" name="address1" class="textfield" placeholder="Address 1" required>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="address2">Address 2:</label>
                    <input type="text" name="address2" class="textfield" placeholder="Address 2" required>
                </div>
                <div class="form-group">
                    <label for="address3">Address 3:</label>
                    <input type="text" name="address3" class="textfield" placeholder="Address 3" required>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="textfield" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Legal Consent:</label>
                    <input type="checkbox" name="medical_history_consent"> I consent to share my medical history<br>
                    <input type="checkbox" name="organ_donation_consent"> I consent to donate my organs for transplantation after my death
                </div>
            </div>
            <div>
                <div class="form-group">
                    <h2>Medical History:</h2>
                </div>
                <div class="form-group">
                    <label for="medicalcondition">Medical Condition:</label>
                    <input type="text" name="medicalcondition" class="textfield" placeholder="Medical Condition" required>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="pastsurgery">Past Surgeries:</label>
                    <input type="text" name="pastsurgery" class="textfield" placeholder="Past Surgeries" required>
                </div>
                <div class="form-group">
                    <label for="pass">Password:</label>
                    <input type="password" name="pass" class="textfield" placeholder="Password" required>
                </div>
            </div>
            <div class="submit-btn-container">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script>
        var canvas = document.getElementById('signature-pad');
        var signaturePad = new SignaturePad(canvas);

        document.querySelector('form').addEventListener('submit', function (e) {
            if (!signaturePad.isEmpty()) {
                var signatureData = signaturePad.toDataURL();
                document.querySelector('input[name="signature"]').value = signatureData;
            }
        });
    </script>

</body>
</html>
