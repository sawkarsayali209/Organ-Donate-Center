
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Added Successfully</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }

        .popup-container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            display: inline-block;
        }

        .popup-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="popup-container" id="popup-container">
    <h2>Data Added Successfully!</h2>
    <p>Your data has been added successfully to the database.</p>
    <button class="popup-button" onclick="closePopup()">Close</button>
</div>

<script>
    // Close the popup and redirect to another page
    function closePopup() {
        window.location.href = 'Organ_Required.php'; // Adjust the URL as needed
    }

    // Automatically close the popup after 5 seconds (you can adjust the timeout)
    setTimeout(function () {
        closePopup();
    }, 5000);
</script>

</body>
</html>