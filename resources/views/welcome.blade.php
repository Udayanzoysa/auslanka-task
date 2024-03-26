<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <style>
        /* Custom styles go here */
    </style>
</head>

<body>
    <div class="container">
        <h1>All Products</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Selling Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Actions</th> <!-- Added for action buttons -->
                </tr>
            </thead>
            <tbody id="productTableBody">
                <!-- Table body content will be added dynamically -->
            </tbody>
        </table>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            // Send AJAX request
            $.ajax({
                url: "http://127.0.0.1:8000/api/products", // Replace with your endpoint
                method: "GET",
                success: function(response) {
                    // Handle success response
                    var products = response.products; // Assuming products is the array containing product objects
                    console.log(products);
                    if (products && products.length > 0) {
                        // Iterate through each product and append to the table
                        $.each(products, function(index, product) {
                            var row = "<tr>" +
                                "<td>" + (index + 1) + "</td>" +
                                "<td>" + product.name + "</td>" +
                                "<td>" + product.sellingPrice + "</td>" +
                                "<td>" + product.quantity + "</td>" +
                                "<td>" + product.created_at + "</td>" +
                                "<td>" + product.updated_at + "</td>" +
                                "<td>" +
                                "<button class='btn btn-primary btn-sm mr-2' onclick='updateProduct(" +
                                product.proID + ")'>Update</button>" +
                                "<button class='btn btn-danger btn-sm mr-2' onclick='deleteProduct(" +
                                product.proID + ")'>Delete</button>" +
                                "<button class='btn btn-success btn-sm' onclick='viewProduct(" +
                                product.proID + ")'>View</button>" +
                                "</td>" +
                                "</tr>";
                            $("#productTableBody").append(row);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                    alert("Something went wrong!. Please try again.");
                },
            });

        });

        // Function to handle updating a product
        function updateProduct(productId) {
            // Implement update logic here
            console.log("Update product with ID: " + productId);
        }

        // Function to handle deleting a product
        function deleteProduct(productId) {
            // Implement delete logic here
            console.log("Delete product with ID: " + productId);
        }

        // Function to handle viewing a product
        function viewProduct(productId) {
            // Implement view logic here
            window.location.href = "/products/" + productId;
            console.log("View product with ID: " + productId);
        }
    </script>
</body>

</html>
