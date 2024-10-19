<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Products</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 240px;
            background-color: #DDE7E7;
            padding-top: 1px;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            justify-content: center; /* Untuk menempatkan ikon dan teks di tengah */
            gap: 10px; /* Memberikan jarak antara ikon dan teks */
            padding: 15px;
            color: #585656;
            text-decoration: none;
            font-size: 18px;
        }
        .sidebar a i {
            font-size: 20px; /* Tambahkan jarak antara ikon dan teks */
        }
        .sidebar a:hover {
            background-color: #2F609C;
            color: #FFD941;
        }
        .sidebar h2 {
            color: #585656;
            text-align: center;
            background-color: #FFD700; /* Yellow background */
            padding: 10px; /* Padding for internal spacing */
            margin: 0; /* Remove the margin */
            height: 100px; /* Set an appropriate height to extend to the top */
            display: flex;
            align-items: center; /* Align content vertically */
            justify-content: center; /* Align content horizontally */
            border-radius: 5px;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }
        .dashboard-overview {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        .card {
            background: #fff;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            text-align: center;
        }
        .card h3 {
            margin: 0;
            font-size: 18px;
            color: #002D72;
        }
        .card .number {
            font-size: 28px;
            color: #28a745;
            margin-top: 10px;
        }
    
        .table-wrapper {
            background: #fff;
            margin-top: 0.2px;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
            transition: background-color 0.3s;
            border-radius: 5px;
        }
        .table-title {
            padding: 15px 15px 5px;
            margin-bottom: 10px;
            background-color: #2F609C;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .table-title h2 {
            margin: 0;
            color: #FFFFFF;
            font-size: 24px;
            flex-grow: 1; 
            
        }
        .table-title .btn {
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
            border: none;
        }
        table.table thead th {
            font-weight: bold;
            background-color: #FFD700;
            color: #002D72;
            text-align: center;
            border-color: #e9e9e9;
            border-width: 2px;
        }
        table.table {
            text-align: center;
        }
        table.table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        table.table-striped > tbody > tr:nth-of-type(even) {
            background-color: #f5f5f5;
        }
        table.table-striped.table-hover tbody tr:hover {
            background: #f0f0f0;
        }
        table.table td {
            vertical-align: middle;
        }
        table.table td a.view {
            color: #03A9F4;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #E34724;
        }

        table.table td img {
            display: block;
            margin: 0 auto;
            max-height: 80px;
            width: auto;
            object-fit: cover;
        }
        .material-icons {
            color: inherit;
        }
        .material-icons:hover {
            color: #FFD700;
        }
        .table-title .btn:hover {
            background-color: #218838;
        }
        .dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }
        .dark-mode .table-wrapper {
            background: #1e1e1e;
        }
        .dark-mode table.table thead th {
            background-color: #333333;
            color: #FFD700;
        }
        .dark-mode .sidebar {
            background-color: #1e1e1e;
        }
        .dark-mode .sidebar a {
            color: #bbb;
        }
        .dark-mode .sidebar a:hover {
            background-color: #333;
            color: #FFD700;
        }
        .dark-mode .sidebar h2 {
            background-color: #333;
            color: #FFD700;
        }
        .dark-mode .main-content {
            background-color: #1e1e1e;
        }
        .dark-mode .card {
            background: #2c2c2c;
            color: #e0e0e0;
        }
        .dark-mode .table-wrapper {
            background: #1e1e1e; 
         }

        .dark-mode .table-title {
            background-color: transparent; 
            border: 2px solid #E7E7E7;
        }
        .dark-mode table.table thead th {
            background-color: #333;
            color: #FFD700;
        }
        .dark-mode table.table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #2c2c2c;
        }
        .dark-mode table.table-striped > tbody > tr:nth-of-type(even) {
            background-color: #1e1e1e;
        }
        .dark-mode table.table-striped.table-hover tbody tr:hover {
            background-color: #444;
        }
        .dark-mode table.table td {
            color: #e0e0e0;
        }

        .dark-mode .material-icons {
            color: #FFD700;
        }
        .dark-mode .material-icons:hover {
            color: #e0e0e0;
        }
        .dark-mode .table-title .btn {
            background-color: #444; 
            color: #fff;
        }
        .dark-mode-toggle {
            position: fixed;
            bottom: 20px;
            left: 200px;
            background-color: #03A9F4;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s, color 0.3s;
        }
        .dark-mode .dark-mode-toggle {
            background-color: #FFD700;
            color: #000;
        }
        
    </style>
</head>
<body>
    <div class="sidebar">
        <h2><i class="fas fa-tachometer-alt" style="margin-right: 10px"></i> Dashboard</h2>
        <a href="#"><i class="fas fa-box"></i> Products</a>
        <a href="{{ url('/supplier') }}"><i class="fas fa-truck"></i> Suppliers</a>
        <a href="{{ url('/transaction') }}"><i class="fas fa-money-bill-wave"></i> Transaction</a>
    </div>

    <div class="main-content">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <h2>Product Management</h2>
                    <a href="{{ route('products.create') }}" class="btn btn-md btn-success mb-3">Add Product</a>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Supplier</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td><img src="{{  asset('storage/images/' . $product->image) }}" alt="Product Image" width="100"></td>
                                <td>{{ ucwords($product->supplier_name) }}</td>
                                <td>{{ ucwords($product->title) }}</td>
                                <td>{{ ucwords($product->product_category_name) }}</td>
                                <td>{{ "Rp " . number_format($product->price,2,',','.') }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('products.show', $product->id) }}" class="view" data-toggle="tooltip" title="View">
                                            <i class="material-icons">&#xE417;</i>
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="edit" data-toggle="tooltip" title="Edit">
                                            <i class="material-icons">&#xE254;</i>
                                        </a>
                                        <a href="#" onclick="showDeleteConfirmation({{ $product->id }})" class="delete" data-toggle="tooltip" title="Delete">
                                            <i class="material-icons">&#xE872;</i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data Products belum Tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>        
    </div>

    <button class="dark-mode-toggle" onclick="toggleDarkMode()"><i class="fas fa-moon"></i></button>

    <script>
        document.querySelectorAll('.material-icons').forEach(function(icon) {
        icon.addEventListener('mouseenter', function() {
            this.style.color = '#FFD700';
        });
        icon.addEventListener('mouseleave', function() {
            this.style.color = '';
        });
    });

        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
        }

        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
        }

        function showDeleteConfirmation(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "you want to delete this data",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E34724',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>