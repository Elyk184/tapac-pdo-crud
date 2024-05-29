<?php
// Include config file
require_once '../../db/config.php';

// Define variables and initialize with empty values
$title = $description = $price = $rrp = $quantity = $img = "";
$title_err = $description_err = $price_err = $rrp_err = $quantity_err = $img_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate title
    $input_title = trim($_POST["title"]);
    if (empty($input_title)) {
        $title_err = "Please enter a title.";
    } else {
        $title = $input_title;
    }

    // Validate description
    $input_description = trim($_POST["description"]);
    if (empty($input_description)) {
        $description_err = "Please enter a description.";
    } else {
        $description = $input_description;
    }

    // Validate price
    $input_price = trim($_POST["price"]);
    if (empty($input_price)) {
        $price_err = "Please enter the price.";
    } elseif (!is_numeric($input_price)) {
        $price_err = "Please enter a valid price.";
    } else {
        $price = $input_price;
    }

    // Validate RRP
    $input_rrp = trim($_POST["rrp"]);
    if (!is_numeric($input_rrp)) {
        $rrp_err = "Please enter a valid RRP.";
    } else {
        $rrp = $input_rrp;
    }

    // Validate quantity
    $input_quantity = trim($_POST["quantity"]);
    if (empty($input_quantity)) {
        $quantity_err = "Please enter the quantity.";
    } elseif (!ctype_digit($input_quantity)) {
        $quantity_err = "Please enter a positive integer value for quantity.";
    } else {
        $quantity = $input_quantity;
    }

    // Validate image
    $input_img = trim($_POST["img"]);
    if (empty($input_img)) {
        $img_err = "Please enter the image URL.";
    } else {
        $img = $input_img;
    }

    // Check input errors before inserting in database
    if (empty($title_err) && empty($description_err) && empty($price_err) && empty($rrp_err) && empty($quantity_err) && empty($img_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO products (title, description, price, rrp, quantity, img) VALUES (:title, :description, :price, :rrp, :quantity, :img)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":rrp", $rrp);
            $stmt->bindParam(":quantity", $quantity);
            $stmt->bindParam(":img", $img);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: ../../index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Create Product</h2>
                <p>Please fill this form and submit to add a new product to the database.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                        <span class="invalid-feedback"><?php echo $title_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                        <span class="invalid-feedback"><?php echo $description_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                        <span class="invalid-feedback"><?php echo $price_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Recommended Retail Price</label>
                        <input type="text" name="rrp" class="form-control <?php echo (!empty($rrp_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $rrp; ?>">
                        <span class="invalid-feedback"><?php echo $rrp_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" name="quantity" class="form-control <?php echo (!empty($quantity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $quantity; ?>">
                        <span class="invalid-feedback"><?php echo $quantity_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Image URL</label>
                        <input type="text" name="img" class="form-control <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $img; ?>">
                        <span class="invalid-feedback"><?php echo $img_err; ?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="../products.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
