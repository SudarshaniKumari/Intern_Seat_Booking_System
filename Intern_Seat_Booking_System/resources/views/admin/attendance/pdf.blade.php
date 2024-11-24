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
    <h1>Attendance Report for {{ $date }}</h1>
    <table>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Training ID</th>
            <th>Seat Number</th>
            <th>Attendance</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $record)
            <tr>
                <td>{{ $record->user->first_name }}</td>
                <td>{{ $record->user->last_name }}</td>
                <td>{{ $record->user->email }}</td>
                <td>{{ $record->training_id }}</td>
                <td>{{ $record->seat_no }}</td>
                <td>{{ $record->is_present ? 'Present' : 'Absent' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
