<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Edit Supplier</title>
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
        <h3>Edit Supplier</h3>
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <form action="{{ route('supplier.update', $data['supplier']->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')  

                    <div class="form-group mb-3">
                        <label for="supplier_name">Supplier Name</label>
                        <input class="form-control @error('supplier_name') is-invalid @enderror" id="supplier_name" name="supplier_name" value="{{ old('supplier_name', $data['supplier']->supplier_name) }}">
                        @error('supplier_name')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">PIC Supplier</label>
                        <input class="form-control @error('pic_supplier') is-invalid @enderror" 
                        name="pic_supplier" placeholder="Masukkan PIC" value="{{ old('pic_supplier', $data['supplier']->pic_supplier) }}">
                        @error('pic_supplier')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">No Hp</label>
                        <input type="text" class="form-control @error('no_hp_pic_supplier') is-invalid @enderror" name="no_hp_pic_supplier" placeholder="Masukkan No HP" value="{{ old('no_hp_pic_supplier', $data['supplier']->no_hp_pic_supplier) }}">
                        @error('no_hp_pic_supplier')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat_supplier">Alamat Supplier</label>
                        <input class="form-control @error('alamat_supplier') is-invalid @enderror" id="alamat_supplier" name="alamat_supplier" value="{{ old('alamat_supplier', $data['supplier']->alamat_supplier) }}">
                        @error('alamat_supplier')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                        <button type="reset" class="btn btn-md btn-warning ms-3">RESET</button>
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
