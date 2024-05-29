<?php
require_once 'a_config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $streetAddress = $_POST['streetAddress'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $country = $_POST['country'];

    // Insert data into database
    $sql = "INSERT INTO addresses (street_address, city, state, postal_code, country) 
            VALUES (:street_address, :city, :state, :postal_code, :country)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':street_address', $streetAddress);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':postal_code', $postalCode);
    $stmt->bindParam(':country', $country);

    try {
        $stmt->execute();
        echo "Address recorded successfully!";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Form</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            text-align: center;
        }
        form {
            display: grid;
            grid-gap: 10px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
<body>
    <h2>Enter Full Address</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
</body>
</html>
