<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the System</title>
</head>
<body>
    <h1>Hello, {{ $user->first_name }} {{ $user->last_name }}!</h1>
    <p>Thank you for registering in our system. Here are your details:</p>
    <ul>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Phone Number:</strong> {{ $user->phone_number }}</li>
        <li><strong>Department:</strong> {{ $user->dep_name }}</li>
        <li><strong>Training ID:</strong> {{ $trainingId }}</li> <!-- Display training_id -->
        <li><strong>University:</strong> {{ $universityName }}</li> <!-- Display university_name -->
        <li><strong>Registration Date:</strong> {{ $registrationDate }}</li>
    </ul>
    <p>We’re thrilled to have you on board!</p>
</body>
</html>
