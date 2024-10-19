<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
        }

        .container-custom {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            background-color: #1d3557;
            padding: 10px 0;
            border-radius: 10px 10px 0 0;
            margin-bottom: 20px;
        }

        .profile-image {
            background-color: #dee2e6;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
            font-size: 40px;
            color: #6c757d;
        }

        .supplier-title {
            font-size: 14px;
            font-weight: bold;
            color: #007bff;
        }

        .supplier-info {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .separator {
            height: 1px;
            background-color: #ddd;
            margin: 15px 0;
        }

        .btn-back {
            background-color: #1d3557;
            color: white;
            border-radius: 5px;
            padding: 10px;
            font-size: 14px;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            width: 100%;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #163346;
            transition: 0.3s;
        }

    </style>
</head>

<body>

    <div class="container container-custom">
        <h3 class="header-title">Supplier Details</h3>

        <!-- Profile image with person icon -->
        <div class="profile-image">
            <i class="bi bi-person"></i>
        </div>

        <!-- Supplier Name -->
        <p class="supplier-title">Supplier Name:</p>
        <p class="supplier-info">{{ ucwords($supplier->supplier_name) }}</p>
        <div class="separator"></div>

        <!-- Supplier Address -->
        <p class="supplier-title">Supplier Address:</p>
        <p class="supplier-info">{{ ucwords($supplier->alamat_supplier) }}</p>
        <div class="separator"></div>

        <!-- PIC Supplier -->
        <p class="supplier-title">PIC Supplier:</p>
        <p class="supplier-info">{{ ucwords($supplier->pic_supplier) }}</p>
        <div class="separator"></div>

        <!-- No. HP PIC Supplier -->
        <p class="supplier-title">No. HP PIC Supplier:</p>
        <p class="supplier-info">{{ ucwords($supplier->no_hp_pic_supplier) }}</p>

        <a href="javascript:history.back()" class="btn-back">Back</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>