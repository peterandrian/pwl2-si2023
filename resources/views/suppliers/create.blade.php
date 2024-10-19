<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Add New Suppliers</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form id="supplierForm" action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="supplier_name">Supplier Name</label>
                                <input class="form-control @error('supplier_name') is-invalid @enderror" id="supplier_name" name="supplier_name" placeholder="Masukkan Nama Supplier">
                                </input>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Pic Supplier</label>
                                <input class="form-control @error('pic_supplier') is-invalid @enderror" name="pic_supplier" rows="5" placeholder="Masukkan Pic Supplier"></input>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">No Hp</label>
                                <input type="text" class="form-control @error('no_hp_pic_supplier') is-invalid @enderror" name="no_hp_pic_supplier" placeholder="Masukkan No Hp">
                            </div>

                            <div class="form-group mb-3">
                                <label for="alamat_supplier">Alamat Supplier</label>
                                <textarea class="form-control @error('alamat_supplier') is-invalid @enderror" id="alamat_supplier" name="alamat_supplier" placeholder="Masukkan Alamat"></textarea>
                                </input>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                            <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning">RESET</button>
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
            document.getElementById("supplierForm").reset(); // Reset semua nilai dalam form

            // Reset CKEditor content to empty
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData(''); // Reset CKEditor content
            }
        }
    </script>