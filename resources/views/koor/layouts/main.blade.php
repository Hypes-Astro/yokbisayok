<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e15a735e77.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!--table-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../css/layout-main.css">
    <title>@yield('title')</title>
    <style>
        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header-custom {
            background-color: #007bff;
            /* Original blue color */
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 1rem;
            font-size: 1.25rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header-custom i {
            font-size: 1.5rem;
        }

        .card-body-custom {
            padding: 1rem;
            background-color: #f8f9fa;
            /* Light gray */
        }

        .card-body-custom a {
            display: block;
            text-align: right;
            text-decoration: none;
            color: #007bff;
            /* Original blue color */
            font-weight: bold;
        }

        .card-body-custom a:hover {
            text-decoration: underline;
        }

        .main {
            flex-grow: 1;
            background-color: #f8f9fa;
            /* Light gray */
            padding: 20px;
        }

        .chart-container {
            position: relative;
            height: 400px;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        .sidebar {
            background-color: #007bff;
            /* Original blue color */
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar .active {
            background-color: #0056b3;
            /* Darker blue for active link */
        }
    </style>
</head>

<body>
    @include('koor.layouts.sidebar')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--table-->
    <script src="../js/layout-main.js"></script>
    @yield('scripts')
</body>

</html>