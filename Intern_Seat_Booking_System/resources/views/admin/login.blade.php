<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../assets/lib/admin/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/lib/admin/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/admin/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/admin/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative  d-flex p-0" style="background-color: powderblue;">
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-110 align-items-center justify-content-center" style="min-height: 110vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-6 p-sm-5 my-6 mx-3">
                        <div class="row flex-grow">
                            <!-- Add Image Here -->
                            <div class="text-center">
                                <img src="../assets/img/admin/logo.png" alt="Sign In Image" style="max-width: 150px; margin-bottom: 20px;">
                            </div>
                            <h2 style="text-align: center; font-weight: bold">Admin Login</h2>
                            <br><br>

                            <!-- Display Errors -->
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form method="POST" action="{{ route('admin.login') }}">
                                @csrf

                                <div class="mb-3">
                                    <input id="email" type="email" class="form-control" name="email" required autofocus placeholder="Enter Email">
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <br>
                                <div class="mb-3">
                                    <input id="password" type="password" class="form-control" name="password" required placeholder="Enter Password">
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <br>

                                <button type="submit" class="btn btn-primary py-2 w-100 mb-4">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/lib/admin/chart/chart.min.js"></script>
    <script src="../assets/lib/admin/easing/easing.min.js"></script>
    <script src="../assets/lib/admin/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/admin/owlcarousel/owl.carousel.min.js"></script>
    <script src="../assets/lib/admin/tempusdominus/js/moment.min.js"></script>
    <script src="../assets/lib/admin/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../assets/lib/admin/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/admin/main.js"></script>
</body>

</html>