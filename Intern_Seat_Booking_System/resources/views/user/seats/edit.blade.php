@extends('layouts.front', ['main_page' => 'yes'])

@section('content')
<div class="container-xxl position-relative d-flex p-0" style="background-color: powderblue;">
     <!-- Edit Booking Form Start -->
     <div class="container-fluid pt-4 px-4">
          <div class="row h-90 align-items-center justify-content-center" style="min-height: 90vh;">
               <div class="col-12 col-lg-8">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                         <div class="text-center mb-4">
                              <img src="{{ asset('assets/img/home/logo.png') }}" alt="Intern Seat Booking Logo" style="max-width: 150px; margin-bottom: 20px;">
                              <p style="font-weight: bold;">Edit Your Booking</p>
                         </div>
                         <!-- Error message display -->
                         @if (session('error'))
                         <div class="alert alert-danger">
                              {{ session('error') }}
                         </div>
                         @endif
                         <!-- Form starts here -->
                         <form action="{{ route('user.seats.update', $booking->id) }}" method="POST" class="row justify-content-center">
                              @csrf
                              @method('PUT') <!-- Use PUT method for updating -->

                              <!-- Date Selection -->
                              <div class="col-12 col-md-6 mb-3">
                                   <label for="booking_date" class="form-label">Select Date:</label>
                                   <input type="date" id="booking_date" name="booking_date" class="form-control text-center" value="{{ $booking->booking_date }}" required>
                              </div>

                              <!-- Seat Selection -->
                              <div class="col-12 col-md-6 mb-3">
                                   <label for="seat_no" class="form-label">Select Seat:</label>
                                   <select id="seat_no" name="seat_no" class="form-control text-center" required>
                                        @foreach($availableSeats as $seat)
                                        <option value="{{ $seat->seat_no }}" {{ $booking->seat_no == $seat->seat_no ? 'selected' : '' }}>{{ $seat->seat_no }}</option>
                                        @endforeach
                                   </select>
                              </div>
                              <br><br>
                              <!-- Buttons -->
                              <div class="row justify-content-center">
                                   <div class="col-12 col-md-4 mb-3 text-center">
                                        <button type="submit" class="btn btn-primary w-100">Update Booking</button>

                                   </div>
                                   <div class="col-12 col-md-4 mb-3 text-center">
                                        <button type="button" class="btn btn-danger w-100" onclick="window.location.href='{{ route('user.seats.index') }}'">Cancel</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
     <!-- Edit Booking Form End -->
</div>


@endsection