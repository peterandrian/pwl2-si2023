<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 50px;
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
                <h3>Add New Supplier</h3>
                <div class="card">
                    <div class="card-body">
                        <form id="supplierForm" action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="supplier_name">Supplier Name</label>
                                <input class="form-control" id="supplier_name" name="supplier_name" placeholder="Masukkan Nama Supplier"></input>
                            </div>

                            <div class="form-group">
                                <label>Pic Supplier</label>
                                <input class="form-control" name="pic_supplier" placeholder="Masukkan Pic Supplier"></input>
                            </div>

                            <div class="form-group">
                                <label>No Hp</label>
                                <input type="text" class="form-control" name="no_hp_pic_supplier" placeholder="Masukkan No Hp"></input>
                            </div>

                            <div class="form-group">
                                <label for="alamat_supplier">Alamat Supplier</label>
                                <textarea class="form-control" id="alamat_supplier" name="alamat_supplier" placeholder="Masukkan Alamat"></textarea>
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
            document.getElementById("supplierForm").reset();
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData('');
            }
        }
    </script>

</body>
</html>
