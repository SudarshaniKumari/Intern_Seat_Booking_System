<!DOCTYPE html>
<html>
<head>
    <title>User and Booking Details PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>{{ $user->first_name }} {{ $user->last_name }}'s Booking Details</h2>

    <!-- User Details -->
    <p><strong>Training ID:</strong> {{ $user->training_id }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Phone Number:</strong> {{ $user->phone_number }}</p>
    <p><strong>Department No:</strong> {{ $user->dep_no }}</p>
    <p><strong>Department Name:</strong> {{ $user->dep_name }}</p>

    <!-- Bookings Table -->
    <h3>Bookings</h3>
    <table>
        <thead>
            <tr>
                <th>Seat No</th>
                <th>Booking Date</th>
                <th>Attendance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->seat_no }}</td>
                    <td>{{ $booking->booking_date }}</td>
                    <td>
                        @if ($booking->is_present)
                            Present
                        @else
                            Absent
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
