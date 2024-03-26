<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Product Details</h5>
                    </div>
                    <div class="card-body" id="productDetails">
                        <p>Product ID: <span id="productId">{{ $proID }}</span></p>
                        <p>Name: <span id="name"></span></p>
                        <p>Selling Price: <span id="selling_price"></span></p>
                        <p>Qty: <span id="qty"></span></p>
                        <p>create_at: <span id="create_at"></span></p>
                        <p>upadte_at: <span id="update_at"></span></p>
                        <!-- Product details will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Send AJAX request
            $.ajax({
                url: "http://127.0.0.1:8000/api/products/{{ $proID }}", // Replace with your endpoint
                method: "GET",
                success: function(response) {
                    // Handle success response
                    var products = response
                        .product; // Assuming products is the array containing product objects

                    console.log(products.name);
                    $("#name").html(products.name);
                    $("#selling_price").html(products.sellingPrice);
                    $("#qty").html(products.quantity);
                    $("#create_at").html(products.created_at);
                    $("#update_at").html(products.updated_at);

                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                    alert("Something went wrong!. Please try again.");
                },
            });

        });
    </script>
</body>

</html>
