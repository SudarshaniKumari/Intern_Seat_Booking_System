<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <title>Seat Booking System</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport">
     <meta content="" name="keywords">
     <meta content="" name="description">
     <link rel="icon" href="../assets/img/logo_1.png" sizes="any" type="image/png">
     <meta name="csrf-token" content="{{ csrf_token() }}">

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

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
     <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>

<body style="background-color: powderblue;">
     <!-- Navbar & Hero Start -->
     <div class="container-fluid nav-bar p-0">
          <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top px-4 px-lg-5 py-3 py-lg-0">
               <a href="" class="navbar-brand p-0">
                    <img src="../assets/img/logo.png" class="img-fluid" alt="">
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


     <!-- Carousel Start -->
     <div class="carousel-header">
          <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
               <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
               </ol>
               <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                         <img src="../assets/img/Table_bg_1.jpg" class="img-fluid" alt="Image">
                         <div class="carousel-caption">
                              <div class="text-center p-4" style="max-width: 900px;">
                                   <h4 class="text-white text-uppercase fw-bold mb-3 mb-md-4 wow fadeInUp" data-wow-delay="0.1s">Book Your Seat Now</h4>
                                   <h1 class="display-1 text-capitalize text-white mb-3 mb-md-4 wow fadeInUp" data-wow-delay="0.3s">SLT Interns Seat Booking System</h1>
                                   <p class="text-white mb-4 mb-md-5 fs-5 wow fadeInUp" data-wow-delay="0.5s">
                                        Reserve your seat for a seamless internship experience. Choose from available slots and ensure your place is secured!
                                   </p>
                                   <a class="btn btn-primary rounded-pill text-white py-3 px-5 wow fadeInUp" data-wow-delay="0.7s" href="{{ route('seats.bookingForm') }}">Seat Booking</a>
                              </div>

                         </div>
                    </div>
                    <div class="carousel-item">
                         <img src="../assets/img/Table_bg_2.jpg" class="img-fluid" alt="Image">
                         <div class="carousel-caption">
                              <div class="text-center p-4" style="max-width: 900px;">
                                   <h4 class="text-white text-uppercase fw-bold mb-3 mb-md-4 wow fadeInUp" data-wow-delay="0.1s">Book Your Seat Now</h4>
                                   <h1 class="display-1 text-capitalize text-white mb-3 mb-md-4 wow fadeInUp" data-wow-delay="0.3s">SLT Interns Seat Booking System</h1>
                                   <p class="text-white mb-4 mb-md-5 fs-5 wow fadeInUp" data-wow-delay="0.5s">
                                        Reserve your seat for a seamless internship experience. Choose from available slots and ensure your place is secured!
                                   </p>
                                   <!-- <a class="btn btn-primary rounded-pill text-white py-3 px-5 wow fadeInUp" data-wow-delay="0.7s" href="#" onclick="showBookingCard()">Seat Booking</a> -->
                                   <a class="btn btn-primary rounded-pill text-white py-3 px-5 wow fadeInUp" data-wow-delay="0.7s" href="{{ route('seats.bookingForm') }}">Seat Booking</a>
                              </div>

                         </div>
                    </div>
               </div>

          </div>
     </div>
     <!-- Carousel End -->


     <!-- Copyright -->
     <div class="container-fluid copyright py-4">
          <div class="container">
               <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-md-0">
                         <span class="text-white"><a href="#" class="border-bottom text-white"><i class="fas fa-copyright text-light me-2"></i></a></span>
                         <span class="text-white"> All Rights Reserved.</span>
                    </div>
               </div>
          </div>
     </div>

     <!-- JavaScript Libraries -->
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

     <!-- Seat Booking Toggle Script -->
     <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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