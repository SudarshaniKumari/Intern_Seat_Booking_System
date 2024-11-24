@extends('layouts.front', ['main_page' => 'yes'])

@section('content')

<div class="container-fluid pt-4 px-4" style="background-color: powderblue;  height: 100vh;">
    <div class="row justify-content-center align-items-center">
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
        <div class="rounded d-flex flex-column align-items-center p-4 text-center" style="height: 250px; background-color:Khaki;">
                <i class="fas fa-chair fa-3x mb-3 " style="color: #32CD32;"></i>
                <br>
                <div>
                    <h6 class="mb-1">Booked Seats</h6>
                    <br>
                    <h2 class="mb-0">{{ $bookingCount }}</h2>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection
