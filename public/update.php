<?php
// Include config file
require_once "../db/config.php";
 
// Define variables and initialize with empty values
$product_name = $product_details = $product_retail_price = "";
$product_name_err = $product_details_err = $product_retail_price_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["product_id"]) && !empty($_POST["product_id"])){
    // Get hidden input value
    $product_id = $_POST["product_id"];
    
    // Validate name
    $input_product_name = trim($_POST["product_name"]);
    if(empty($input_product_name)){
        $product_name_err = "Please enter a name.";
    } elseif(!filter_var($input_product_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $product_name_err = "Please enter a valid name.";
    } else{
        $product_name = $input_product_name;
    }
    
    // Validate product details
    $input_product_details = trim($_POST["product_details"]);
    if(empty($input_product_details)){
        $aproduct_details_err = "Please enter product details.";     
    } else{
        $product_details = $input_product_details;
    }
    
    // Validate product retail price
    $input_product_retail_price = trim($_POST["product_retail_price"]);
    if(empty($input_product_retail_price)){
        $product_retail_price_err = "Please enter the retail price amount.";     
    } elseif(!ctype_digit($input_product_retail_price)){
        $product_retail_price_err = "Please enter a positive integer value.";
    } else{
        $product_retail_price = $input_product_retail_price;
    }
    
    // Check input errors before inserting in database
    if(empty($product_name_err) && empty($product_details_err) && empty($product_retail_price_err)){
        // Prepare an update statement
        $sql = "UPDATE products SET product_name=:product_name, product_details=:product_details, product_retail_price=:product_retail_price WHERE product_id=:product_id";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":product_name", $param_product_name);
            $stmt->bindParam(":product_details", $param_product_details);
            $stmt->bindParam(":product_retail_price", $param_product_retail_price);
            $stmt->bindParam(":product_id", $param_product_id);
            
            // Set parameters
            $param_product_name = $product_name;
            $param_product_details = $product_details;
            $param_product_retail_price = $product_retail_price;
            $param_product_id = $product_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: ../index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["product_id"]) && !empty(trim($_GET["product_id"]))){
        // Get URL parameter
        $product_id =  trim($_GET["product_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM products WHERE product_id = :product_id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":product_id", $param_product_id);
            
            // Set parameters
            $param_product_id = $product_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $product_name = $row["product_name"];
                    $product_details = $row["product_details"];
                    $product_retail_price = $row["product_retail_price"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: ../public/error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: ../public/error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the product record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="product_name" class="form-control <?php echo (!empty($product_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product_name; ?>">
                            <span class="invalid-feedback"><?php echo $product_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Product Details</label>
                            <textarea name="product_details" class="form-control <?php echo (!empty($product_details_err)) ? 'is-invalid' : ''; ?>"><?php echo $product_details; ?></textarea>
                            <span class="invalid-feedback"><?php echo $product_details_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Product Retail Price</label>
                            <input type="text" name="product_retail_price" class="form-control <?php echo (!empty($product_retail_price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product_retail_price; ?>">
                            <span class="invalid-feedback"><?php echo $product_retail_price_err;?></span>
                        </div>
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>