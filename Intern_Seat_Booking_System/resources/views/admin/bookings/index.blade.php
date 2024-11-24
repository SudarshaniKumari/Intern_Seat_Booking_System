@extends('admin.layouts.admin')

@section('content')
<div class="app-content my-3 my-md-5">
    <div class="side-app">
        <div class="page-header"></div>
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800 text-center">Bookings List</h1>
                <div class="d-flex align-items-center">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('admin.bookings.index') }}" class="mr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Enter Seat No" value="{{ request('search') }}" style="background-color: #E0FFFF;">
                            <div class="input-group-append">
                                <button class="btn btn-primary ms-2" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    @if (isset($message))
                    <div class="alert alert-warning">
                        {{ $message }}
                    </div>
                    @endif
                </div>
            </div>

            <table class="table table-bordered" style="border-color: black; background-color:#FFFFE0;">
                <thead style="background-color: #EEE8AA;">
                    <tr>
                        <th class="text-center" style="font-weight: bold;">#</th>
                        <th class="text-center" style="font-weight: bold; width: 150px;">
                            <a href="{{ route('admin.bookings.index', ['sort_by' => 'first_name', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" style="color: black;">
                                User Name
                                <i class="fa-solid fa-arrow-up {{ request('sort_by') === 'first_name' && request('order') === 'asc' ? '' : 'text-muted' }}" ></i>
                                <i class="fa-solid fa-arrow-down {{ request('sort_by') === 'first_name' && request('order') === 'desc' ? '' : 'text-muted' }}" ></i>
                            </a>
                        </th>
                        <th class="text-center" style="font-weight: bold;">
                            <a href="{{ route('admin.bookings.index', ['sort_by' => 'training_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" style="color: black;">
                                Training ID
                                <i class="fa-solid fa-arrow-up {{ request('sort_by') === 'training_id' && request('order') === 'asc' ? '' : 'text-muted' }}" ></i>
                                <i class="fa-solid fa-arrow-down {{ request('sort_by') === 'training_id' && request('order') === 'desc' ? '' : 'text-muted' }}" ></i>
                            </a>
                        </th>
                        <th class="text-center" style="font-weight: bold;">
                            <a href="{{ route('admin.bookings.index', ['sort_by' => 'seat_no', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" style="color: black;">
                                Seat No
                                <i class="fa-solid fa-arrow-up {{ request('sort_by') === 'seat_no' && request('order') === 'asc' ? '' : 'text-muted' }}" ></i>
                                <i class="fa-solid fa-arrow-down {{ request('sort_by') === 'seat_no' && request('order') === 'desc' ? '' : 'text-muted' }}" ></i>
                            </a>
                        </th>
                        <th class="text-center" style="font-weight: bold;">
                            <a href="{{ route('admin.bookings.index', ['sort_by' => 'booking_date', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" style="color: black;">
                                Booking Date
                                <i class="fa-solid fa-arrow-up {{ request('sort_by') === 'booking_date' && request('order') === 'asc' ? '' : 'text-muted' }}" ></i>
                                <i class="fa-solid fa-arrow-down {{ request('sort_by') === 'booking_date' && request('order') === 'desc' ? '' : 'text-muted' }}"></i>
                            </a>
                        </th>
                        <th class="text-center" style="font-weight: bold;">
                            <a href="{{ route('admin.bookings.index', ['sort_by' => 'email', 'order' => request('order') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" style="color: black;">
                                Email
                                <i class="fa-solid fa-arrow-up {{ request('sort_by') === 'email' && request('order') === 'asc' ? '' : 'text-muted' }}" ></i>
                                <i class="fa-solid fa-arrow-down {{ request('sort_by') === 'email' && request('order') === 'desc' ? '' : 'text-muted' }}" ></i>
                            </a>
                        </th>
                        <th class="text-center" style="font-weight: bold;">Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $key => $booking)
                    <tr>
                        <td class="text-center">{{ $loop->iteration + ($bookings->currentPage() - 1) * $bookings->perPage() }}</td>
                        <td class="text-center">{{ $booking->first_name }} {{ $booking->last_name }}</td>
                        <td class="text-center">{{ $booking->training_id }}</td>
                        <td class="text-center">{{ $booking->seat_no }}</td>
                        <td class="text-center">{{ $booking->booking_date }}</td>
                        <td class="text-center">{{ $booking->email }}</td>
                        <td class="text-center">
                            @php
                            $today = \Carbon\Carbon::now()->format('Y-m-d');
                            @endphp
                            <!-- Attendance Buttons -->
                            @if($today == $booking->booking_date)
                            <form method="POST" action="{{ route('admin.bookings.markAttendance', $booking->id) }}">
                                @csrf
                                @if(!$booking->is_present)
                                <button class="btn btn-primary" type="submit" name="status" value="present">Mark Present</button>
                                @else
                                <button class="btn btn-success" disabled>Present</button>
                                @endif
                                @if($booking->is_present)
                                <button class="btn btn-danger" type="submit" name="status" value="absent">Mark Absent</button>
                                @endif
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <!-- Pagination -->
                        @if ($bookings->onFirstPage())
                        <li class="page-item disabled"><a class="page-link">Previous</a></li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $bookings->previousPageUrl() }}">Previous</a></li>
                        @endif

                        <li class="page-item active">
                            <span class="page-link">{{ str_pad($bookings->currentPage(), 2, '0', STR_PAD_LEFT) }}</span>
                        </li>

                        @if ($bookings->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $bookings->nextPageUrl() }}">Next</a></li>
                        @else
                        <li class="page-item disabled"><a class="page-link">Next</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection