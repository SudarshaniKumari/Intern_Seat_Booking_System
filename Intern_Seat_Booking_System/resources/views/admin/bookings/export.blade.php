<table>
    <thead>
        <tr>
            <th>User Name</th>
            <th>Training ID</th>
            <th>Seat No</th>
            <th>Booking Date</th>
            <th>Email</th>
            <th>Attendance</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $booking)
        <tr>
            <td>{{ $booking->user->first_name }} {{ $booking->user->last_name }}</td>
            <td>{{ $booking->training_id }}</td>
            <td>{{ $booking->seat_no }}</td>
            <td>{{ $booking->booking_date }}</td>
            <td>{{ $booking->user->email }}</td>
            <td>{{ $booking->is_present ? 'Present' : 'Absent' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
