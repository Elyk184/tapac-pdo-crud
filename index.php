<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    .card {  /* Style for individual cards */
        width: 100%; /* Ensure cards take full width of their container */
        background-color: transparent;
        border: 4px solid #ffffff; 
        box-shadow: 0 0 10px rgba(138, 43, 226, 0.9);

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
    
    /* Center align the search bar */
    .search-bar {
        display: flex;
        justify-content: center;
        margin-top: 20px; /* Add some top margin for separation */
    }
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <!-- Removed the Bootstrap logo -->
    </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline my-2 my-lg-0 ml-auto">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div id="productsDisplay" class="card-grid"></div>
    <div id="cartContainer"></div>

    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody"></div>
                <div class="modal-footer">
                    <a id="paymentLink" class="btn btn-primary" href="#">Proceed to Payment</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                            <span class="price">Price: ₱${product.rrp}</span>
                            <p class="card-text">${product.description}</p>
                            <p class="card-text">Quantity: ${product.quantity}</p>
                            <button class="btn btn-success" onclick="showProductModal('${product.title}', '${product.rrp}')">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>`;
                    productsContainer.innerHTML += cardHTML;
                });
            })
            .catch(error => console.error('Error:', error));

        function showProductModal(title, price) {
            document.getElementById('modalBody').innerHTML = `
                <p>Name: ${title}</p>
                <p>Price: ₱${price}</p>`;
            document.getElementById('paymentLink').href = `admin/payment/payment.php?productName=${encodeURIComponent(title)}&price=${encodeURIComponent(price)}`;
            $('#productModal').modal('show');
        }

        let cart = {};

        function addToCart(productId) {
            if (cart[productId]) {
                cart[productId]++;
            } else {
                cart[productId] = 1;
            }
            displayCart();
        }

        function displayCart() {
            const cartContainer = document.getElementById('cartContainer');
            let cartHTML = '<h3>Cart</h3>';
            for (const [productId, quantity] of Object.entries(cart)) {
                cartHTML += `<p>Product ID: ${productId}, Quantity: ${quantity}</p>`;
            }
            cartContainer.innerHTML = cartHTML;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>