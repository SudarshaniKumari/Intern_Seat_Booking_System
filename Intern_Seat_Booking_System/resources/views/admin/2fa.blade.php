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

     <style>
/*** Navbar ***/

.sticky-top {
    z-index: 1030; /* Ensure it's above other content */
    background-color: var(--bs-white); /* Background color */
}


.navbar-light .navbar-nav .nav-link {
    font-family: 'Poppins', sans-serif;
    position: relative;
    margin-right: 25px;
    padding: 35px 0;
    color: var(--bs-primary) !important;
    font-size: 17px;
    font-weight: 400;
    outline: none;
    transition: .5s;
}

.sticky-top .navbar-light .navbar-nav .nav-link {
    padding: 20px 0;
    color: var(--bs-primary) !important;
}

.navbar-light .navbar-nav .nav-link:hover,
.navbar-light .navbar-nav .nav-link.active {
    color: var(--bs-secondary) !important;
}

.navbar-light .navbar-brand img {
    max-height: 60px;
    transition: .5s;
}

.sticky-top .navbar-light .navbar-brand img {
    max-height: 45px;
}

.navbar .dropdown-toggle::after {
    border: none;
    content: "\f107";
    font-family: "Font Awesome 5 Free";
    font-weight: 600;
    vertical-align: middle;
}

@media (min-width: 1200px) {
    .navbar .nav-item .dropdown-menu {
        display: block;
        visibility: hidden;
        top: 100%;
        transform: rotateX(-75deg);
        transform-origin: 0% 0%;
        border: 0;
        border-radius: 10px;
        transition: .5s;
        opacity: 0;
    }
}

.dropdown .dropdown-menu a:hover {
    background: var(--bs-primary);
    color: var(--bs-secondary);
}

.navbar .nav-item:hover .dropdown-menu {
    transform: rotateX(0deg);
    visibility: visible;
    background: var(--bs-light) !important;
    transition: .5s;
    opacity: 1;
}

@media (max-width: 991.98px) {
    .sticky-top {
        position: relative;
        background: var(--bs-white);
    }

    .navbar.navbar-expand-lg .navbar-toggler {
        padding: 10px 20px;
        border: 1px solid var(--bs-primary) !important;
        color: var(--bs-primary);
    }

    .navbar-light .navbar-collapse {
        margin-top: 15px;
        border-top: 1px solid #DDDDDD;
    }

    .navbar-light .navbar-nav .nav-link,
    .sticky-top .navbar-light .navbar-nav .nav-link {
        padding: 10px 0;
        margin-left: 0;
        color: var(--bs-dark) !important;
    }

    .navbar-light .navbar-brand img {
        max-height: 45px;
    }
}

@media (min-width: 991.98px) {
    .sticky-top .navbar-light {
        background: var(--bs-light) !important;
    }

    /*** Top and Bottom borders go out ***/
    .navbar-light .navbar-nav .nav-link:after,
    .navbar-light .navbar-nav .nav-link::before {
        position: absolute;
        content: "";
        top: 30px;
        bottom: 30px;
        left: 0px;
        width: 100%;
        height: 2px;
        background: var(--bs-primary);
        opacity: 0;
        transition: all 0.5s;
    }

    .navbar-light .navbar-nav .nav-link:before {
        bottom: auto;
    }

    .navbar-light .navbar-nav .nav-link:after {
        top: auto;
    }

    .navbar-light .navbar-nav .nav-link:hover:before,
    .navbar-light .navbar-nav .nav-link.active:before {
        top: 20px;
        opacity: 1;
    }

    .navbar-light .navbar-nav .nav-link:hover::after,
    .navbar-light .navbar-nav .nav-link.active::after {
        bottom: 20px;
        opacity: 1;
    }
}

#searchModal .modal-content {
    background: rgba(240, 245, 251, 0.5);
}
/*** Navbar End ***/</style>
</head>

<body style="background-color: powderblue; overflow: hidden;">
     <!-- Navbar & Hero Start -->
     <div class="container-fluid nav-bar p-0">
          <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
               <a href="" class="navbar-brand p-0">
                    <img src="../assets/img/logo.png" class="img-fluid" alt="">
                    <!-- <img src="img/logo.png" alt="Logo"> -->
               </a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                         <a href="{{ url('/') }}" class="nav-item nav-link  ">Home</a>
                         @guest

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
          <div class="container-fluid">
               <div class="row h-110 align-items-center justify-content-center" style="min-height: 80vh;">
                    <div class="col-md-8">
                         <div class="card bg-light">
                              <div class="card-header">Admin 2FA Authentication</div>
                              <div class="card-body">
                                   <form action="{{ route('admin.2fa.verify') }}" method="POST">
                                        @csrf

                                        {{-- General error message --}}
                                        @if ($message = Session::get('error'))
                                        <div class="alert alert-danger">
                                             {{ $message }}
                                        </div>
                                        @endif

                                        {{-- Field-specific validation errors --}}
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                             <ul>
                                                  @foreach ($errors->all() as $error)
                                                  <li>{{ $error }}</li>
                                                  @endforeach
                                             </ul>
                                        </div>
                                        @endif


                                        {{-- Form Fields --}}
                                        <div class="form-group row">
                                             <label for="code" class="col-md-4 col-form-label text-md-right">Authentication Code</label>
                                             <div class="col-md-6">
                                                  <input type="text" id="code" name="code" class="form-control" required maxlength="6">

                                                  {{-- Field-specific error for code --}}
                                                  @error('code')
                                                  <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                  </span>
                                                  @enderror
                                             </div>
                                        </div>
                                        <br>
                                        <div class="form-group row mb-0">
                                             <div class="col-md-8 offset-md-4">
                                                  <button type="submit" class="btn btn-primary py-2 mb-4">Verify</button>
                                             </div>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
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