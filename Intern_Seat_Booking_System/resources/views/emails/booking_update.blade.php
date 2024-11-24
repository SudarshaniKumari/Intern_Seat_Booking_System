<!DOCTYPE html>
<html>
<head>
    <title>Booking Updated</title>
</head>
<body>
    <h1>Your Booking Has Been Updated</h1>
    <p>Dear {{ Auth::user()->first_name }},</p>
    <p>Your booking has been updated successfully. Here are your new booking details:</p>

    <ul>
        <li><strong>Booking ID:</strong> {{ $bookingId }}</li>
        <li><strong>Training ID:</strong> {{ $trainingId }}</li>
        <li><strong>Seat Number:</strong> {{ $seatNo }}</li>
        <li><strong>Booking Date:</strong> {{ $bookingDate }}</li>
    </ul>

    <p>If you have any questions, feel free to contact us.</p>

    <p>Thank you for using our service!</p>
</body>
</html>
