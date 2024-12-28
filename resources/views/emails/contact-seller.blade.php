<!DOCTYPE html>
<html>
<head>
    <title>رسالة جديدة عن سيارتك</title>
</head>
<body>
    <h1>لقد استلمت رسالة عن سيارتك: {{ $data['car_title'] }}</h1>
    <p><strong>الاسم:</strong> {{ $data['name'] }}</p>
    <p><strong>البريد الإلكتروني:</strong> {{ $data['email'] }}</p>
    <p><strong>رقم الهاتف:</strong> {{ $data['phone'] }}</p>
    <p><strong>الرسالة:</strong> {{ $data['message'] }}</p>
</body>
</html>
