<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CSS -->
    <style>
    body {
        font-family: Arial, sans-serif;
        /* Remove the overflow-x property */
        /* overflow-x: hidden; */
        /* Background properties */
        background-image: url('https://c0.wallpaperflare.com/preview/1013/496/951/mockup-bakery-bread-pastry.jpg');
        background-color: #f8f9fa;
        background-size: cover;
        background-position: center;
        /* Adjusting margin to 0 for the body to remove default margin */
        margin: 0;
        /* Ensuring body takes full height of viewport */
        min-height: 100vh;
    }
    

    /* Define a class for the grid */
    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Responsive grid with minimum item width of 250px */
        gap: 20px; /* Gap between grid items */
        padding: 20px; /* Add padding around the grid container */
        max-width: 1200px; /* Set maximum width */
        margin: 0 auto; /* Center align the grid */
        overflow-x: auto; /* Add horizontal scrollbar */
    }

    /* Style for individual cards */
    .card {
        width: 100%; /* Ensure cards take full width of their container */
    }

    .card-img-top{
        width: 100%; /* Ensure the image fills its container */
        height: auto; /* Maintain aspect ratio */
        object-fit: cover; /* Ensure the image covers the entire container */
    }
    .card-img-top {
    width: 100%; /* Ensure the image fills its container */
    height: 200px; /* Set a fixed height for the images */
    object-fit: cover; /* Ensure the image covers the entire container */
}


    /* Style for the cart */
    #cartContainer {
        position: fixed;
        top: 4em;
        right: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 10px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 999;
    }
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        Bootstrap
    </a>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<div id="productsDisplay" class="card-grid"></div>
<!-- Cart Display Area -->
<div id="cartContainer"></div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Product details will be filled here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="admin/payment/payment.php" class="btn btn-primary" id="buyButton">Buy</a>
            </div>
        </div>
    </div>
</div>

<script>
    fetch('./products/products-api.php')
        .then(response => response.json())
        .then(data => {
            const productsContainer = document.getElementById('productsDisplay');
            data.forEach(product => {
                const cardHTML = `
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="${product.img}">
                    <div class="card-body">
                        <h5 class="card-title">${product.title}</h5>
                        <p class="card-text">Price: ₱${product.rrp}</p>
                        <p class="card-text">${product.description}</p>
                        <p class="card-text">Quantity: ${product.quantity}</p>
                        <button class="btn btn-success" onclick="showProductModal('${product.title}', '${product.rrp}')">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
                `;
                productsContainer.innerHTML += cardHTML;
            });
        })
        .catch(error => console.error('Error:', error));

    // Function to display the product modal
    function showProductModal(title, price) {
        document.getElementById('modalBody').innerHTML = `
            <p>Name: ${title}</p>
            <p>Price: ₱${price}</p>
        `;
        $('#productModal').modal('show');
    }

    // Initialize cart object
    let cart = {};

    // Function to add a product to the cart
    function addToCart(productId) {
        // Add the product to the cart
        if (cart[productId]) {
            cart[productId]++;
        } else {
            cart[productId] = 1;
        }
        // Display the updated cart
        displayCart();
    }

    // Function to display the cart with the items added and deduct the values from the quantity data field
    function displayCart() {
        const cartContainer = document.getElementById('cartContainer');
        let cartHTML = '<h3>Cart</h3>';
        // Iterate over the cart items and display them
        for (const [productId, quantity] of Object.entries(cart)) {
            cartHTML += `<p>Product ID: ${productId}, Quantity: ${quantity}</p>`;
            // Here, you can update the quantity data field for the corresponding product
        }
        // Update the cart display
        cartContainer.innerHTML = cartHTML;
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>