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
        <div class="container-fluid  pt-4 px-4">
            <div class="row h-110 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-sm-12">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="row flex-grow">
                            <!-- Add Image Here -->
                            <div class="text-center">
                                <img src="../assets/img/logo.png" alt="Sign In Image" style="max-width: 150px; margin-bottom: 20px;">
                            </div>
                            <h2 style="text-align: center; font-weight: bold">Sign UP</h2>
                            <br>
                            <br>
                            <p style="text-align: center;"> Create a new account to access seat availability, make bookings, and manage your reservations seamlessly. Stay organized throughout your internship by keeping track of your bookings and seat preferences.</p>
                            <br><br><br><br>
                            <form method="POST" action="">
                                @csrf
                                <div class="row">
                                    <!-- First Row -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name">First Name<span class="text-danger">*</span></label>
                                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name">Last Name<span class="text-danger">*</span></label>
                                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="training_id">Training ID<span class="text-danger">*</span></label>
                                            <input id="training_id" type="text" class="form-control @error('training_id') is-invalid @enderror" name="training_id" value="{{ old('training_id') }}" required pattern="\d{4}" title="Training ID must be exactly 4 digits" maxlength="4">
                                            @error('training_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <!-- Second Row -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="university">University<span class="text-danger">*</span></label>
                                            <select id="university" class="form-control @error('university_name') is-invalid @enderror" name="university_name" required>
                                                <option value="" disabled selected>Select your university</option>
                                                @foreach($universities as $university)
                                                <option value="{{ $university->name }}" {{ old('university_name') == $university->name ? 'selected' : '' }}>
                                                    {{ $university->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('university_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="department">Department<span class="text-danger">*</span></label>
                                            <select id="department" class="form-control @error('department') is-invalid @enderror" name="department" required>
                                                <option value="" disabled selected>Select your department</option>
                                                @foreach($departments as $department)
                                                <option value="{{ $department->dep_no }}" {{ old('department') == $department->dep_no ? 'selected' : '' }}>{{ $department->dep_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('department')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Email Address<span class="text-danger">*</span></label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <!-- Third Row -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number<span class="text-danger">*</span></label>
                                            <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required pattern="\d{10}" title="Phone number must be 10 digits" maxlength="10">
                                            @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password">Password<span class="text-danger">*</span></label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password-confirm">Confirm Password<span class="text-danger">*</span></label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>



                                <br>

                                <div class="form-group mb-0">
                                    <div class="checkbox checkbox-secondary d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary rounded-pill  me-2">Sign UP</button>

                                    </div>
                                </div>
                                <br>
                                <p class="text-center mb-0">Do your have an Account? <a href="{{ route('login') }}" style="color: blue ">Sign IN</a></p>
                            </form>
                            <!-- <button type="submit" class="btn btn-primary py-2 w-100 mb-4">Sign UP</button>
                                <p class="text-center mb-0">Don't have an Account? <a href="{{ route('login') }}" style="color: blue ">Sign IN</a></p>
                            </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-white"><a href="#" class="border-bottom text-white"><i class="fas fa-copyright text-light me-2"></i>SLT</a>, All right reserved.</span>
                </div>

            </div>
        </div>
    </div>
    <!-- Copyright End -->
    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a> -->


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