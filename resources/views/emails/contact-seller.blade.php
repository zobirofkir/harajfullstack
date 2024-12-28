<!DOCTYPE html>
<html>
<head>
    <title>New Message About Your Car</title>
</head>
<body>
    <h1>You have received a message about your car: {{ $data['car_title'] }}</h1>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    <p><strong>Message:</strong> {{ $data['message'] }}</p>
</body>
</html>
