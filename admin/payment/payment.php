<?php
require_once 'p_config.php';

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$productName = '';
$price = '';

if (isset($_GET['productName']) && isset($_GET['price'])) {
    $productName = sanitize_input($_GET['productName']);
    $price = sanitize_input($_GET['price']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = sanitize_input($_POST['productName']);
    $price = sanitize_input($_POST['price']);
    $paymentMethod = sanitize_input($_POST['paymentMethod']);

    if (!empty($productName) && !empty($price) && !empty($paymentMethod)) {
        $sql = "INSERT INTO payments (product_name, price, payment_method) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sds", $productName, $price, $paymentMethod);

        if ($stmt->execute()) {
            $paymentId = $stmt->insert_id;
            $stmt->close();
            header("Location: address.php?paymentId=$paymentId");
            exit();
        } else {
            echo "Error: Unable to record payment.";
        }
    } else {
        echo "Error: All fields are required.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
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

        input[type="text"],
        input[type="number"],
        select {
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
        <h2>Make Payment</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" value="<?php echo $productName; ?>" readonly>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo $price; ?>" readonly>

            <label for="paymentMethod">Payment Method:</label>
            <select id="paymentMethod" name="paymentMethod">
                <option value="PayMaya">PayMaya</option>
                <option value="GCash">GCash</option>
                <option value="PayPal">PayPal</option>
            </select>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
