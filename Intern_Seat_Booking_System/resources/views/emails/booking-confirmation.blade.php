<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Booking Confirmation</h1>
    <p>Dear {{ Auth::user()->first_name }},</p>
    <p>You have successfully booked a seat.</p>
    <p><strong>Training ID:</strong> {{ $trainingId }}</p>
    <p><strong>Booking Date:</strong> {{ $bookingDate }}</p>
    <p><strong>Seat No:</strong> {{ $seatNo }}</p>
    <p>Thank you for using our service!</p>
</body>
</html>
