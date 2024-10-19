<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Edit Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Edit Supplier</h3>
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <form action="{{ route('supplier.update', $data['supplier']->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')  

                                <div class="form-group mb-3">
                                    <label for="supplier_name">Supplier Name</label>
                                    <input class="form-control" id="supplier_name" name="supplier_name"></input>
                                    <!-- error message untuk product_category_id -->
                                    @error('supplier_name')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">PIC Supplier</label>
                                    <input class="form-control @error('description') is-invalid @enderror" 
                                    name="pic_supplier" placeholder="Masukkan PIC"></input>

                                    <!-- error message untuk description -->
                                    @error('pic_supplier')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">No Hp</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="no_hp_pic_supplier" placeholder="Masukkan No HP">
                                    <!-- error message untuk title -->
                                    @error('no_hp_pic_supplier')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="alamat_supplier">Alamat Supplier</label>
                                    <input class="form-control" id="alamat_supplier" name="alamat_supplier">
                                    </input>
                                    <!-- error message untuk alamat_supplier -->
                                    @error('alamat_supplier')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                                <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            </form>

                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
</body>
</html