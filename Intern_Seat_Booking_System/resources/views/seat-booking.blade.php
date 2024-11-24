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
     <div class="container-xxl position-relative d-flex p-0" style="background-color: powderblue;">
          <!-- Booking Card Start -->
          <div class="container-fluid pt-4 px-4">
               <div class="row h-110 align-items-center justify-content-center" style="min-height: 110vh;">
                    <div class="col-12 col-lg-8">
                         <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                              <div class="text-center mb-4">
                                   <img src="../assets/img/logo.png" alt="Intern Seat Booking Logo" style="max-width: 150px; margin-bottom: 20px;">
                                   <h2 style="font-weight: bold">Intern Seat Booking System</h2>
                                   <p>Welcome! Please select your booking options below.</p>
                              </div>

                              <!-- Form starts here -->
                              <form id="bookingForm" class="row justify-content-center">
                                   <!-- Date Selection -->
                                   <div class="col-12 col-md-6 mb-3">
                                        <label for="booking_date" class="form-label">Select Date:</label>
                                        <input type="date" id="booking_date" class="form-control text-center" required>
                                   </div>

                                   <div class="col-12 col-md-6 mb-3">
                                        <label for="seat_no" class="form-label">Select Seat:</label>
                                        <div id="seatGrid" class="seat-grid" style="display: flex; flex-wrap: wrap; justify-content: center;">
                                             @foreach($seats as $seat)
                                             <div class="seat-icon" style="flex: 1 1 25%; max-width: 25%; display: inline-block; margin: 10px 0; cursor: pointer; text-align: center; min-width: 60px;" onmouseover="displaySeatNumber(this, '{{ $seat->seat_no }}')" onmouseout="hideSeatNumber(this)" onclick="selectSeat('{{ $seat->seat_no }}')">
                                                  <i class="fas fa-chair" style="font-size: 2rem; color: #32CD32;"></i>
                                                  <div class="seat-number" style="font-size: 0.9rem; margin-top: 5px; color: #FF6347;">
                                                       {{ $seat->seat_no }}
                                                  </div>
                                             </div>
                                             @endforeach
                                        </div>
                                        <!-- Display selected seat number -->
                                        <div id="selectedSeatDisplay" style="margin-top: 15px; font-weight: bold; color: #007bff;"></div>
                                   </div>

                                   <!-- Hidden input to store the selected seat number -->
                                   <input type="hidden" id="seat_no" name="seat_no">
                              </form>

                              <br><br>
                              <!-- Buttons for Availability and Booking -->
                              <div class="row justify-content-center">
                                   <div class="col-12 col-md-4 mb-3 text-center">
                                        <button type="button" class="btn btn-success mb-2 w-100" onclick="checkAvailability()">Check Availability</button>
                                   </div>
                                   <div class="col-12 col-md-4 mb-3 text-center">
                                        <button type="button" class="btn btn-primary mb-2 w-100" id="bookButton" style="display:none;" onclick="bookSeat()">Book Now</button>
                                   </div>
                                   <div class="col-12 col-md-4 mb-3 text-center">
                                        <button type="button" class="btn btn-danger w-100" onclick="closeBookingCard()">Close</button>
                                   </div>
                              </div>

                              <!-- Availability Message -->
                              <div id="availabilityMessage" class="text-center mt-3"></div>
                         </div>
                    </div>
               </div>
          </div>
          <!-- Booking Card End -->
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
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

     <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
     <script>
          document.addEventListener('DOMContentLoaded', function() {
               // Initialize Flatpickr for date selection
               flatpickr("#booking_date", {
                    dateFormat: "Y-m-d",
                    disable: [
                         function(date) {
                              return (date.getDay() === 0 || date.getDay() === 6); // Disable weekends (Sunday and Saturday)
                         },
                         function(date) {
                              const holidays = {
                                   '8': ["2024-09-16", "2024-09-17"], // September holidays
                                   '9': ["2024-10-17", "2024-10-31"], // October holidays
                                   '10': ["2024-11-15"] // November holidays
                              };

                              const monthIndex = date.getMonth().toString();
                              return holidays[monthIndex] && holidays[monthIndex].includes(flatpickr.formatDate(date, "Y-m-d"));
                         }
                    ],
                    minDate: "today",
                    maxDate: getMaxDate(),
               });
          });

          function getMaxDate() {
               const today = new Date();
               const maxDate = new Date(today);
               maxDate.setDate(today.getDate() + 14);
               return maxDate;
          }

          function selectSeat(seatNo) {
               // Set the selected seat number to the hidden input
               document.getElementById('seat_no').value = seatNo;

               // Highlight the selected seat button and display seat number
               const buttons = document.querySelectorAll('.seat-icon');
               buttons.forEach(button => {
                    button.classList.remove('selected');
                    // Hide previously displayed seat numbers
                    button.querySelector('.seat-number').style.display = 'none';
               });

               // Show the selected seat number
               const selectedButton = [...buttons].find(button => button.querySelector('.seat-number').innerText === seatNo);
               selectedButton.classList.add('selected');
               selectedButton.querySelector('.seat-number').style.display = 'block'; // Show selected seat number

               // Clear previous availability message
               document.getElementById('availabilityMessage').innerHTML = '';
          }


          function displaySeatNumber(element, seatNo) {
               // Set the selected seat number to the hidden input
               document.getElementById('seat_no').value = seatNo;

               // Update the display of the selected seat number
               const selectedSeatDisplay = document.getElementById('selectedSeatDisplay');
               selectedSeatDisplay.innerHTML = `Selected Seat: ${seatNo}`; // Display the selected seat number

               // Display the seat number in the icon
               const seatNumberSpan = element.querySelector('.seat-number');
               seatNumberSpan.style.display = 'block'; // Show the seat number
          }

          function hideSeatNumber(element) {
               // Hide the seat number when not hovering
               const seatNumberSpan = element.querySelector('.seat-number');
               seatNumberSpan.style.display = 'none'; // Hide the seat number
          }

          function checkAvailability() {
               const seatNumber = $('#seat_no').val();
               const bookingDate = $('#booking_date').val();

               if (seatNumber && bookingDate) {
                    $.ajax({
                         url: '{{ route("seats.checkAvailability") }}',
                         type: 'POST',
                         data: {
                              seat_no: seatNumber,
                              booking_date: bookingDate,
                              _token: '{{ csrf_token() }}'
                         },
                         success: function(response) {
                              if (response.available) {
                                   $('#availabilityMessage').html('<span class="text-success">Seat is available!</span>');
                                   $('#bookButton').show();
                              } else {
                                   $('#availabilityMessage').html('<span class="text-danger">Seat is already booked for this date.</span>');
                                   $('#bookButton').hide();
                              }
                         }
                    });
               } else {
                    $('#availabilityMessage').html('<span class="text-danger">Please select a seat and date.</span>');
               }
          }

          function bookSeat() {
               const seatNumber = $('#seat_no').val();
               const bookingDate = $('#booking_date').val();

               $.ajax({
                    url: '{{ route("seats.book") }}',
                    type: 'POST',
                    data: {
                         seat_no: seatNumber,
                         booking_date: bookingDate,
                         _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                         if (response.success) {
                              $('#availabilityMessage').html('<span class="text-success">Seat successfully booked!</span>');
                              $('#bookButton').hide();
                         } else if (response.redirect) {
                              window.location.href = '{{ route("login") }}';
                         } else {
                              $('#availabilityMessage').html('<span class="text-danger">' + response.message + '</span>');
                         }
                    }
               });
          }

          function closeBookingCard() {
               window.location.href = '{{ route("user.seats.index") }}';
          }
     </script>


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