@extends('admin/layouts/admin')

@section('content')
<div class="app-content my-3 my-md-5">
    <div class="side-app">
        <div class="page-header"></div>
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <form class="d-none d-md-flex ms-4" action="{{ route('admin.seats.index') }}" method="GET">
                    <input class="form-control border-1" type="search" name="search" placeholder="Search Seat Number" style="background-color: #E0FFFF;" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary ms-2"> <i class="fas fa-search"></i></button>
                </form>
                <div class="d-flex align-items-center">
                    <a href="{{ route('admin.seats.create') }}" class="btn btn-success">Add Seats</a>
                </div>
            </div>
            <br>

            <div class="row">
                <!-- Booked Seats Table -->
                <div class="col-12 col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-body p-2" style="background-color: #FFF9E3;">
                            <h4 class="mb-3" style="text-align: center;">Booked Seats</h4>
                            <div class="seat-icon-grid text-center">
                                @if($bookedSeats->isEmpty())
                                <p class="text-center text-danger">No booked seats found for the search query.</p>
                                @else
                                <!-- Render each booked seat as an icon with seat number displayed below -->
                                <div class="d-flex flex-wrap justify-content-center">
                                    @foreach($bookedSeats as $seat)
                                    <div class="seat-icon" style="display: inline-block; margin: 10px; cursor: pointer; text-align: center;">
                                        <i class="fas fa-chair" style="font-size: 2rem; color: #FF6347;"></i>
                                        <div class="seat-number" style="font-size: 0.9rem; margin-top: 5px; color: #FF6347;">
                                            {{ $seat->seat_no }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Pagination for Booked Seats -->
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $bookedSeats->links() }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available Seats Table -->
                <div class="col-12 col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-body p-2" style="background-color: #FAF5EF;">
                            <h4 class="mb-3" style="text-align: center;">Available Seats</h4>
                            <div class="seat-icon-grid text-center">
                                @if($availableSeats->isEmpty())
                                <p class="text-center text-danger">No available seats found for the search query.</p>
                                @else
                                <!-- Render each available seat as an icon with seat number displayed below -->
                                <div class="d-flex flex-wrap justify-content-center">
                                    @foreach($availableSeats as $seat)
                                    <div class="seat-icon" style="display: inline-block; margin: 10px; cursor: pointer; text-align: center;">
                                        <i class="fas fa-chair" style="font-size: 2rem; color: #32CD32;"></i>
                                        <div class="seat-number" style="font-size: 0.9rem; margin-top: 5px; color: #32CD32;">
                                            {{ $seat->seat_no }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- Available Seats Pagination -->
                                <div class="d-flex justify-content-center">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            <!-- Previous Page Link -->
                                            @if ($availableSeats->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">Previous</a>
                                            </li>
                                            @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $availableSeats->previousPageUrl() }}">Previous</a>
                                            </li>
                                            @endif

                                            <!-- Current Page Number -->
                                            <li class="page-item active">
                                                <span class="page-link">
                                                    {{ str_pad($availableSeats->currentPage(), 2, '0', STR_PAD_LEFT) }} <!-- Add leading zero -->
                                                </span>
                                            </li>

                                            <!-- Next Page Link -->
                                            @if ($availableSeats->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $availableSeats->nextPageUrl() }}">Next</a>
                                            </li>
                                            @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">Next</a>
                                            </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection