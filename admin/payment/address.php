<?php
require_once 'a_config.php'; // Include database connection configuration

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $streetAddress = $_POST['streetAddress'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $country = $_POST['country'];
    $paymentId = $_GET['paymentId']; // Retrieve payment ID from URL parameter

    if (empty($paymentId)) {
        echo "Error: Payment ID is missing.";
        exit; // Stop execution if payment ID is missing
    }

    // Insert data into addresses table
    $sql = "INSERT INTO addresses (street_address, city, state, postal_code, country, payment_id) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$streetAddress, $city, $state, $postalCode, $country, $paymentId]);

    if ($stmt->rowCount() > 0) {
        // Redirect to successful.php
        header("Location: successful.php");
        exit();
    } else {
        echo "Error: Unable to record address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            width: auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Enter Full Address</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?paymentId=<?php echo $_GET['paymentId']; ?>" method="post">
            <label for="streetAddress">Street Address:</label><br>
            <input type="text" id="streetAddress" name="streetAddress"><br><br>

            <label for="city">City:</label><br>
            <input type="text" id="city" name="city"><br><br>

            <label for="state">State:</label><br>
            <input type="text" id="state" name="state"><br><br>

            <label for="postalCode">Postal Code:</label><br>
            <input type="text" id="postalCode" name="postalCode"><br><br>

            <label for="country">Country:</label><br>
            <input type="text" id="country" name="country"><br><br>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>