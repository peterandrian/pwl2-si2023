<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Aligning items from top */
            padding-top: 50px; /* Adding space from the top to prevent cutting */
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 700px;
            padding: 20px;
        }
        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 20px;
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
            padding: 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            background-color: #e5e9ec;
            box-shadow: 0 4px 10px rgba(69, 123, 157, 0.2);
        }
        .btn-primary {
            background-color: #457b9d;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            font-weight: 500;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #1d3557;
        }
        .btn-warning {
            background-color: #f4a261;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            font-weight: 500;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .btn-warning:hover {
            background-color: #e76f51;
        }
        .btn-container {
            display: flex;
            gap: 15px;
        }
        .row .col-md-6 {
            padding: 0 5px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        textarea.form-control {
            resize: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Add New Products</h3>
                <div class="card">
                    <div class="card-body">
                        <form id="productForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>IMAGE</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class="form-group">
                                <label for="product_category_id">Product Category</label>
                                <select class="form-control" id="product_category_id" name="product_category_id">
                                    <option value="">-- Select Category Product --</option>
                                    @foreach ($data['categories'] as $category)
                                        <option value="{{ $category->id }}">{{ $category->product_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_supplier">Supplier</label>
                                <select class="form-control" id="id_supplier" name="id_supplier">
                                    <option value="">-- Select Supplier --</option>
                                    @foreach ($data['suppliers'] as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>TITLE</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Product Title">
                            </div>

                            <div class="form-group">
                                <label>DESCRIPTION</label>
                                <textarea class="form-control" name="description" rows="4" placeholder="Enter Product Description"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>PRICE</label>
                                        <input type="number" class="form-control" name="price" placeholder="Enter Product Price">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>STOCK</label>
                                        <input type="number" class="form-control" name="stock" placeholder="Enter Product Stock">
                                    </div>
                                </div>
                            </div>

                            <div class="btn-container">
                                <button type="submit" class="btn btn-md btn-primary">SAVE</button>
                                <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning">RESET</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('description');

        function resetForm() {
            document.getElementById("productForm").reset();
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData('');
            }
        }
    </script>

</body>
</html>
