@extends('layouts.front', ['main_page' => 'yes'])

@section('content')
<div class="container-xxl position-relative d-flex p-0" style="background-color: powderblue;">
     <!-- Booking Card Start -->
     <div class="container-fluid pt-4 px-4">
          <div class="row h-90 align-items-center justify-content-center" style="min-height: 100vh;">
               <div class="col-12 col-lg-8">
                    <div class="rounded p-4 p-sm-5 my-4 mx-3" style="background-color: #FFFFE0;">
                         <div class="text-center mb-4">
                              <img src="{{ asset('assets/img/home/logo.png') }}" alt="Intern Seat Booking Logo" style="max-width: 150px; margin-bottom: 20px;">
                              <p style="font-weight: bold;">Welcome! Please select your booking options below.</p>
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
                                   <div id="seatGrid" class="seat-grid">
                                        @foreach($seats as $seat)
                                        <div class="seat-icon" style="display: inline-block; margin: 10px; cursor: pointer;" onmouseover="displaySeatNumber(this, '{{ $seat->seat_no }}')" onmouseout="hideSeatNumber(this)">
                                             <i class="fas fa-chair" style="font-size: 2rem; color:  #32CD32;"></i>
                                             <span class="seat-number" style="display: none;">{{ $seat->seat_no }}</span> <!-- Hidden span for the seat number -->
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
                                   <button type="button" class="btn btn-success rounded-pill mb-2 w-100" onclick="checkAvailability()">Check Availability</button>
                              </div>
                              <div class="col-12 col-md-4 mb-3 text-center">
                                   <button type="button" class="btn btn-primary rounded-pill mb-2 w-100" id="bookButton" style="display:none;" onclick="bookSeat()">Book Now</button>
                              </div>
                              <div class="col-12 col-md-4 mb-3 text-center">
                                   <button type="button" class="btn btn-danger rounded-pill w-100" onclick="closeBookingCard()">Close</button>
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

@endsection