<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 50px;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 800px;
            padding: 20px;
        }
        .card {
            background-color: #ffffff;
            border-radius: 20px;
            border: none;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #1d3557;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            color: #457b9d;
            font-weight: 500;
        }
        .form-control {
            border: none;
            background-color: #f0f4f8;
            border-radius: 10px;
            padding: 12px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            background-color: #e5e9ec;
            box-shadow: 0 4px 10px rgba(69, 123, 157, 0.2);
        }
        .btn-success, .btn-danger, .btn-primary, .btn-warning {
            border-radius: 12px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 500;
        }
        .btn-success {
            background-color: #2a9d8f;
            border: none;
        }
        .btn-success:hover {
            background-color: #21867a;
        }
        .btn-danger {
            background-color: #e63946;
            border: none;
        }
        .btn-danger:hover {
            background-color: #d62839;
        }
        .btn-primary {
            background-color: #457b9d;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1d3557;
        }
        .btn-warning {
            background-color: #f4a261;
            border: none;
        }
        .btn-warning:hover {
            background-color: #e76f51;
        }
        .product-row {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .d-flex.align-items-center {
            gap: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Add New Transaction</h3>
                <div class="card">
                    <div class="card-body">
                        <form id="transactionForm" action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group mb-4">
                                <label for="email_pembeli">Buyer Email</label>
                                <input type="email" class="form-control" id="email_pembeli" name="email_pembeli" placeholder="Enter Buyer Email" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="nama_kasir_id">Cashier Name</label>
                                <select class="form-control" id="nama_kasir_id" name="nama_kasir_id">
                                    <option value="">-- Select Cashier --</option>
                                    @foreach ($data['cashiers'] as $cashier)
                                        <option value="{{ $cashier->id }}">{{ ucwords($cashier->nama_kasir) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product container for dynamic products -->
                            <div id="product-container">
                                <div class="product-row">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group mb-3">
                                                <label for="id_product">Product Name</label>
                                                <select class="form-control product-select" name="id_product[]">
                                                    <option value="">-- Select Product --</option>
                                                    @foreach ($data['products'] as $product)
                                                        <option value="{{ $product->id }}">{{ ucwords($product->title) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label for="quantity">Quantity</label>
                                                <input type="number" class="form-control" name="quantity[]" placeholder="Enter Quantity">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-danger remove-product-btn mt-4">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Flex container for buttons with consistent spacing -->
                            <div class="d-flex align-items-center mb-3">
                                <button type="button" class="btn btn-success me-3" id="addProductBtn">Add Product</button>
                                <button type="submit" class="btn btn-primary me-3">Save</button>
                                <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-warning">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('addProductBtn').addEventListener('click', function() {
            var productContainer = document.getElementById('product-container');
            var newProductRow = document.querySelector('.product-row').cloneNode(true);
            newProductRow.querySelector('input').value = '';
            newProductRow.querySelector('select').value = '';

            productContainer.appendChild(newProductRow);

            attachRemoveButtonEvent(newProductRow);
            attachProductChangeEvent(newProductRow);
            updateProductOptions();
        });

        function attachRemoveButtonEvent(row) {
            row.querySelector('.remove-product-btn').addEventListener('click', function() {
                if (document.querySelectorAll('.product-row').length > 1) {
                    row.remove();
                    updateProductOptions();
                } else {
                    alert('You need at least one product row.');
                }
            });
        }

        function attachProductChangeEvent(row) {
            row.querySelector('.product-select').addEventListener('change', function() {
                updateProductOptions();
            });
        }

        function updateProductOptions() {
            var selectedProducts = [];
            document.querySelectorAll('.product-select').forEach(function(select) {
                selectedProducts.push(select.value);
            });

            document.querySelectorAll('.product-select').forEach(function(select) {
                select.querySelectorAll('option').forEach(function(option) {
                    if (option.value !== '' && selectedProducts.includes(option.value)) {
                        option.disabled = (option.value !== select.value);
                    } else {
                        option.disabled = false;
                    }
                });
            });
        }

        attachRemoveButtonEvent(document.querySelector('.product-row'));
        attachProductChangeEvent(document.querySelector('.product-row'));

        function resetForm() {
            document.getElementById("transactionForm").reset();
        }

        function addInitialProduct() {
            var productContainer = document.getElementById('product-container');
            var productRow = `
                <div class="product-row mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group mb-3">
                                <label for="id_product">Product Name</label>
                                <select class="form-control product-select" name="id_product[]">
                                    <option value="">-- Select Product --</option>
                                    @foreach ($data['products'] as $product)
                                        <option value="{{ $product->id }}">{{ ucwords($product->title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" name="quantity[]" placeholder="Enter Quantity">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <button type="button" class="btn btn-danger remove-product-btn mt-4">Remove</button>
                        </div>
                    </div>
                </div>
            `;
            productContainer.innerHTML = productRow;

            attachRemoveButtonEvent(document.querySelector('.product-row'));
            attachProductChangeEvent(document.querySelector('.product-row'));
        }

        addInitialProduct();
    </script>
</body>
</html>
