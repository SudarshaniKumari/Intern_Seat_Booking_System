<!DOCTYPE html>
<html>

<head>
     <title>Booking Cancellation Notification</title>
</head>

<body>
     <h1>Booking Cancellation</h1>

     <p>Dear {{ $booking->user->first_name }},</p>

     <p>Your booking for the training (ID: {{ $trainingId }}) has been successfully canceled. Below are the details of the canceled booking:</p>

     <ul>
          <li>Booking ID: {{ $id }}</li>
          <li>Seat Number: {{ $seat_no }}</li>
          <li>Booking Date: {{ $booking_date }}</li>
     </ul>

     <p>If you have any questions, feel free to contact us.</p>

     <p>Thank you!</p>
</body>

</html>