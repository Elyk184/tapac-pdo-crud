<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body{ font: 14px sans-serif; text-align: center; }
     
        table tr td:last-child{
            width: 120px;
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="dashboard.php">Admin</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">Dashboard </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="products.php">Products<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
     <!--<a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>-->
        <a href="../public/user/logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </form>
  </div>
</nav>
<body>

    <div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Product Details</h2>
                    <a href="./inventory/create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Product</a>
                </div>
                <?php
                // Include config file
                require_once "../db/config.php";
                
                // Attempt select query execution
                $sql = "SELECT * FROM products";
                if($result = $pdo->query($sql)){
                    $totalRows = $result->rowCount();

                    if($result->rowCount() > 0){
                        // Define the table template
                        $tableTemplate = '
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                        </th>
                                        <th class="text-center" colspan="8"><h6>Showing ' . $totalRows . ' / ' . $totalRows . ' Records</h6></th>

                                        </tr>
                                    </thead>                               
                                </table>
                              
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Record Number</th>
                                            <th>Product Name</th>
                                            <th>Product Description</th>
                                            <th>Price</th>
                                            <th>Recommended Retail Price</th>
                                            <th>Quantity</th>
                                            <th>Image</th>
                                            <th>Date Added</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{rows}}
                                    </tbody>
                                </table>
                   
                        ';
                
                        // Define the row template
                        $rowTemplate = '
                            <tr>
                                <td>{{id}}</td>
                                <td>{{title}}</td>
                                <td>{{description}}</td>
                                <td>{{price}}</td>
                                <td>{{rrp}}</td>
                                <td>{{quantity}}</td>
                                <td>{{img}}</td>
                                <td>{{date_added}}</td>
                                <td>
                                    <a href="./inventory/read.php?id={{id}}" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>
                                    <a href="./inventory/update.php?id={{id}}" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                                    <a href="./inventory/delete.php?id={{id}}" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>
                                </td>
                            </tr>
                        ';
                
                        // Populate the rows using the row template
                        $rows = '';
                        while ($row = $result->fetch()) {
                            $rowHtml = str_replace(
                                array('{{id}}', '{{title}}', '{{description}}', '{{price}}', '{{rrp}}', '{{quantity}}', '{{img}}', '{{date_added}}'),
                                array($row['id'], $row['title'], $row['description'], $row['price'], $row['rrp'], $row['quantity'], $row['img'], $row['date_added']),
                                $rowTemplate
                            );
                            $rows .= $rowHtml;
                        }
                
                        // Replace the rows placeholder in the table template with the actual rows
                        echo str_replace('{{rows}}', $rows, $tableTemplate);
                        
                        // Free result set
                        unset($result);
                    } else{
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                
                // Close connection
                unset($pdo);
                ?>
            </div>
        </div>        
    </div>
    </div>

</body>
</html>