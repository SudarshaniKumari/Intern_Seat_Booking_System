@extends('admin/layouts/admin')

@section('content')
<!-- Dashboard Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row justify-content-center align-items-center">
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none" style="display: block;">
                <div class="rounded d-flex flex-column align-items-center p-4 text-center" style="height: 250px; background-color: #FAFAD2;">
                    <i class="fa fa-users fa-3x mb-3 text-primary icon-hover"></i> <!-- Added icon-hover class -->
                    <div>
                        <br>
                        <h6 class="mb-1">Users</h6>
                        <br>
                        <h2 class="mb-0">{{ $userCount }}</h2>
                    </div>
                </div>
            </a>
        </div>



        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
            <a href="{{ route('admin.bookings.index') }}" class="text-decoration-none" style="display: block;">
                <div class="rounded d-flex flex-column align-items-center p-4 text-center" style="height: 250px; background-color: PeachPuff;">
                    <i class="fa fa-book fa-3x mb-3 text-success icon-hover"></i>
                    <br>
                    <div>
                        <h6 class="mb-1">Bookings</h6>
                        <br>
                        <h2 class="mb-0">{{ $bookingCount }}</h2>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
            <a href="{{ route('admin.seats.index') }}" class="text-decoration-none" style="display: block;">
                <div class="rounded d-flex flex-column align-items-center p-4 text-center" style="height: 250px; background-color: Khaki;">
                    <i class="fas fa-chair fa-3x mb-3  icon-hover" style="color: #32CD32;"></i>
                    <br>
                    <div>
                        <h6 class="mb-1">Available Seats</h6>
                        <br>
                        <h2 class="mb-0">{{ $availableSeatCount }}</h2>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
    <a href="{{ route('admin.seats.index') }}" class="text-decoration-none" style="display: block;">
        <div class="rounded d-flex flex-column align-items-center p-4 text-center" style="height: 250px; background-color:#FAF0E6;">
            <i class="fas fa-chair fa-3x mb-3 icon-hover" style="color: #FF6347;"></i> <!-- Updated icon color here -->
            <br>
            <div>
                <h6 class="mb-1">Booked Seats</h6>
                <br>
                <h2 class="mb-0">{{ $bookedSeatCount }}</h2>
            </div>
        </div>
    </a>
</div>


    </div>
</div>
<!-- Dashboard End -->

@endsection