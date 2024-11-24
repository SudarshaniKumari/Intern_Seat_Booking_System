<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SLT_Intern_Seat Booking System - Admin </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->

    <link href="../assets/img/home/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('../../assets/lib/admin/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('../../assets/lib/admin/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('../../assets/css/admin/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('../../assets/css/admin/style.css') }}" rel="stylesheet">
   


</head>

<body>
    <div class="content d-flex flex-column min-vh-100">

        @component('admin.components.header')
        @endcomponent

        @component('admin.components.sidebar')
        @endcomponent

        <main class="flex-grow-1">
            @yield('content')
        </main>

    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });
    </script>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('../../assets/lib/admin/chart/chart.min.js') }}"></script>
    <script src="{{ asset('../../assets/lib/admin/easing/easing.min.js') }}"></script>
    <script src="{{ asset('../../assets/lib/admin/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('../../assets/lib/admin/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('../../assets/lib/admin/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('../../assets/lib/admin/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('../../assets/lib/admin/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('../../assets/js/admin/main.js') }}"></script>
</body>

</html>