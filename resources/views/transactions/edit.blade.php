<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Edit Transaction</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form id="transactionForm" action="{{ route('transaction.update', $data['transactions']->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                            <!-- Cashier Selection -->
                            <div class="form-group mb-3">
                                <label for="nama_kasir_id">Nama Kasir</label>
                                <select class="form-control" id="nama_kasir_id" name="nama_kasir_id">
                                    <option value="">-- Cashier Name --</option>
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
                                                    <label for="id_product">Nama Produk</label>
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
                                                    <label class="font-weight-bold">QUANTITY</label>
                                                    <input type="number" class="form-control" name="quantity[]" value="{{ explode(', ', $data['transactions']->jumlah_pembelian)[$index] }}" min="1" placeholder="Enter Quantity">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-danger remove-product-btn mt-4">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Add Product Button -->
                            <button type="button" class="btn btn-md btn-success mb-3" id="addProductBtn">ADD PRODUCT</button>

                            <!-- Save Changes Button -->
                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE CHANGES</button>
                            <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
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
