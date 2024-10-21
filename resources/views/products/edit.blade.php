<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Edit Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
        }
        .container {
            max-width: 700px;
            margin: auto;
            padding: 20px;
        }
        h3 {
            text-align: center;
            color: #495057;
            margin-bottom: 30px;
        }
        .card {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .form-control {
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #ced4da;
        }
        label {
            font-weight: 600;
            color: #495057;
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
        .form-group {
            margin-bottom: 20px;
        }
        .alert {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <h3>Edit Product</h3>
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <form action="{{ route('products.update', $data['product']->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">IMAGE</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                        @error('image')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="product_category_id">Product Category</label>
                        <select class="form-control" id="product_category_id" name="product_category_id">
                            <option value="">-- Select Category Product --</option>
                            @foreach ($data['categories'] as $category)
                                <option value="{{ $category->id }}" @if(old('product_category_id', $data['product']->product_category_id) == $category->id) selected @endif>
                                    {{ $category->product_category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_category_id')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="supplier_id">Supplier</label>
                        <select class="form-control" id="supplier_id" name="supplier_id">
                            <option value="">-- Select Supplier --</option>
                            @foreach ($data['suppliers'] as $supplier)
                                <option value="{{ $supplier->id }}" @if(old('supplier_id', $data['product']->supplier_id) == $supplier->id) selected @endif>
                                    {{ $supplier->supplier_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">TITLE</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                               value="{{ old('title', $data['product']->title) }}" placeholder="Enter Product Title">
                        @error('title')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">DESCRIPTION</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  name="description" rows="5" placeholder="Enter Product Description">{{ old('description', $data['product']->description) }}</textarea>
                        @error('description')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">PRICE</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                                       value="{{ old('price', $data['product']->price) }}" placeholder="Enter Product Price">
                                @error('price')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">STOCK</label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                       name="stock" value="{{ old('stock', $data['product']->stock) }}" placeholder="Enter Product Stock">
                                @error('stock')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                        <button type="reset" class="btn btn-md btn-warning ms-3">RESET</button> <!-- Margin kiri untuk tombol RESET -->
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</body>
</html>
