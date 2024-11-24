<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Seat Booking System </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" href="../assets/img/logo_1.png" sizes="any" type="image/png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/another-style.css') }}"> -->


</head>

<body>
    <!-- Navbar & Hero Start -->
    <div class="container-fluid nav-bar p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <img src="../assets/img/logo.png" class="img-fluid" alt="">
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('seats.bookingForm') }}" class="nav-item nav-link {{ request()->routeIs('seats.bookingForm') ? 'active' : '' }}">Booking</a>
                    @guest
                    @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="nav-item nav-link {{ request()->routeIs('login*') ? 'active' : '' }}">Login</a>
                    @endif
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-item nav-link {{ request()->routeIs('register*') ? 'active' : '' }}">Register</a>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </div>
            </div>
        </nav>
    </div>

    <!-- Navbar & Hero End -->
    <div class="container-xxl position-relative  d-flex p-0" style="background-color: powderblue;">
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-110 align-items-center justify-content-center" style="min-height: 120vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-6 p-sm-5 my-6 mx-3">
                        <div class="row flex-grow">
                            <!-- Add Image Here -->
                            <div class="text-center">
                                <img src="../assets/img/logo.png" alt="Sign In Image" style="max-width: 150px; margin-bottom: 20px;">
                            </div>
                            <h2 style="text-align: center; font-weight: bold">Sign In</h2>
                            <br><br>
                            <p style="text-align: center;">Welcome to the Intern Seat Booking System. Please sign in to access seat availability, manage bookings, and stay up-to-date with your reservations.</p>
                            <br><br><br><br>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email">
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <br>
                                <div class="mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Password">
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <br>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" style="color: blue ">Forgot Password ?</a>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary rounded-pill py-2 w-100 mb-4">Sign In</button>

                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('facebook.login') }}" class="d-flex align-items-center me-3">
                                        <img src="{{ asset('assets/img/facebook.png') }}" alt="Facebook" style="width: 70px; height: 70px; margin-right: 8px;">
                                    </a>

                                    <a href="{{ url('auth/google') }}" class="d-flex align-items-center" style="font-weight: bold;">
                                        <img src="{{ asset('assets/img/google.png') }}" alt="Continue with Google" style="width: 70px; height: 70px; margin-right: 8px;">
                                    </a>
                                </div>

                             <br>



                                <p class="text-center mb-0">Don't have an Account? <a href="{{ route('register') }}" style="color: blue ">Sign Up</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>



    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-white"><a href="#" class="border-bottom text-white"><i class="fas fa-copyright text-light me-2"></i>SLT</a>, All right reserved.</span>
                </div>

            </div>
        </div>
    </div>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/lib/wow/wow.min.js"></script>
    <script src="../assets/lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/counterup/counterup.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>
</body>

</html>