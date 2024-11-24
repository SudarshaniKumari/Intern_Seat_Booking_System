@extends('layouts.front', ['main_page' => 'yes'])

@section('content')
<div class="container-fluid pt-4 px-4" style="background-color: powderblue; height: 95vh;">
    <div class="row">
        <div class="col-10">
            <h2 style="text-align: center;">Your Bookings</h2>

            <!-- Error message display -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Button aligned to the right corner -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('user.seats.create') }}" class="btn btn-success">Add New Booking</a>
            </div>

            <!-- Table for displaying bookings -->
            <table class="table table-bordered" style="border-color: black; background-color:#FFFFE0;">
                <thead style="background-color: #EEE8AA;">
                    <tr>
                        <th class="text-center" style="font-weight: bold;">ID</th>
                        <th class="text-center">Training ID</th>
                        <th class="text-center">Seat Number</th>
                        <th class="text-center">Booking Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($bookings->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">No bookings found.</td>
                    </tr>
                    @else
                    @foreach($bookings as $booking)
                        @php
                            $isPastBooking = \Carbon\Carbon::parse($booking->booking_date)->isPast();
                        @endphp
                        <tr @if($isPastBooking) style="background-color: #f8d7da;" @endif> <!-- Highlight past bookings with a different color -->
                            <td class="text-center">{{ $booking->id }}</td>
                            <td class="text-center">{{ $booking->training_id }}</td>
                            <td class="text-center">{{ $booking->seat_no }}</td>
                            <td class="text-center">{{ $booking->booking_date }}</td>
                            <td class="text-center">
                                @if(!$isPastBooking)
                                    <!-- Action buttons for updating or canceling bookings if the booking date is in the future -->
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('user.seats.edit', ['id' => $booking->id]) }}" class="btn btn-primary me-2"><i class="fas fa-user-edit"></i></a>
                                        <form action="{{ route('user.seats.delete', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                @else
                                    <!-- Show a message or icon indicating that past bookings cannot be edited or deleted -->
                                    <span class="text-muted">Unavailable</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
