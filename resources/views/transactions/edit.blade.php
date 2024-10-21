<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
        }
        h3 {
            color: #343a40;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .card {
            border-radius: 15px;
            border: none;
            padding: 30px;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
            color: #495057;
        }
        .form-control {
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #ced4da;
        }
        .btn-success, .btn-danger, .btn-primary, .btn-warning {
            border-radius: 12px;
            padding: 12px;
            width: 150px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-success {
            background-color: #457b9d;
        }
        .btn-success:hover {
            background-color: #1d3557;
        }
        .btn-warning {
            background-color: #f4a261;
        }
        .btn-warning:hover {
            background-color: #e76f51;
        }
        .remove-product-btn {
            border-radius: 50px;
            background-color: #e63946;
            color: white;
            transition: background-color 0.3s;
        }
        .remove-product-btn:hover {
            background-color: #d62839;
        }
        .alert {
            margin-top: 10px;
        }
        .product-row {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container mt-5 mb-5">
        <h3>Edit Transaction</h3>
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <form id="transactionForm" action="{{ route('transaction.update', $data['transactions']->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Cashier Selection -->
                    <div class="form-group mb-3">
                        <label for="nama_kasir_id">Cashier Name</label>
                        <select class="form-control" id="nama_kasir_id" name="nama_kasir_id">
                            <option value="">-- Select Cashier --</option>
                            @foreach ($data['cashiers'] as $cashier)
                                <option value="{{ $cashier->id }}" {{ $cashier->id == $data['transactions']->id_kasir ? 'selected' : '' }}>
                                    {{ ucwords($cashier->nama_kasir) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Product container for dynamic products -->
                    <div id="product-container">
                        @foreach (explode(', ', $data['transactions']->product_names) as $index => $productName)
                            <div class="product-row">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group mb-3">
                                            <label for="id_product">Product Name</label>
                                            <select class="form-control product-select" name="id_product[]">
                                                <option value="">-- Select Product --</option>
                                                @foreach ($data['products'] as $product)
                                                    <option value="{{ $product->id }}" {{ $product->title == $productName ? 'selected' : '' }}>
                                                        {{ ucwords($product->title) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold">Quantity</label>
                                            <input type="number" class="form-control" name="quantity[]" value="{{ explode(', ', $data['transactions']->jumlah_pembelian)[$index] }}" min="1" placeholder="Enter Quantity">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <button type="button" class="btn remove-product-btn mt-4">Remove</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Button Row -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-md btn-success mx-2" id="addProductBtn">Add Product</button>
                        <button type="submit" class="btn btn-md btn-primary mx-2">Save Changes</button>
                        <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning mx-2">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to add a new product row
        document.getElementById('addProductBtn').addEventListener('click', function() {
            var productContainer = document.getElementById('product-container');
            var newProductRow = document.querySelector('.product-row').cloneNode(true); // Clone the product row
            newProductRow.querySelector('input').value = ''; // Clear the quantity input
            newProductRow.querySelector('select').value = ''; // Clear the product selection

            // Append the new product row to the container
            productContainer.appendChild(newProductRow);

            // Attach event listeners
            attachRemoveButtonEvent(newProductRow);
            attachProductChangeEvent(newProductRow);
            updateProductOptions(); // Update available product options
        });

        // Function to remove a product row
        function attachRemoveButtonEvent(row) {
            row.querySelector('.remove-product-btn').addEventListener('click', function() {
                if (document.querySelectorAll('.product-row').length > 1) {
                    row.remove(); // Remove the product row
                    updateProductOptions(); // Update available product options after removal
                } else {
                    alert('You need at least one product row.');
                }
            });
        }

        // Function to handle product selection change
        function attachProductChangeEvent(row) {
            row.querySelector('.product-select').addEventListener('change', function() {
                updateProductOptions();
            });
        }

        // Function to update product dropdown options based on selected values
        function updateProductOptions() {
            var selectedProducts = [];
            document.querySelectorAll('.product-select').forEach(function(select) {
                selectedProducts.push(select.value);
            });

            document.querySelectorAll('.product-select').forEach(function(select) {
                select.querySelectorAll('option').forEach(function(option) {
                    if (option.value !== '' && selectedProducts.includes(option.value)) {
                        if (option.value === select.value) {
                            option.disabled = false; // Don't disable the currently selected option
                        } else {
                            option.disabled = true; // Disable options already selected in other rows
                        }
                    } else {
                        option.disabled = false;
                    }
                });
            });
        }

        // Initially attach the remove button listeners
        attachRemoveButtonEvent(document.querySelector('.product-row'));
        attachProductChangeEvent(document.querySelector('.product-row'));

        function resetForm() {
            document.getElementById("transactionForm").reset(); // Reset all values in the form
        }
    </script>
</body>
</html>
