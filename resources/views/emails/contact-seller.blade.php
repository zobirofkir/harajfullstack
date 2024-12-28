<!DOCTYPE html>
<html>
<head>
    <title>رسالة جديدة عن سيارتك</title>
</head>
<body>
    <p><strong>الاسم:</strong> {{ $data['name'] }}</p>
    <p><strong>البريد الإلكتروني:</strong> {{ $data['email'] }}</p>
    <p><strong>رقم الهاتف:</strong> {{ $data['phone'] }}</p>
    <p><strong>الرسالة:</strong> {{ $data['message'] }}</p>
    <p><strong>عنوان السيارة:</strong> {{ $data['car_title'] }}</p>
    <p><strong>رابط السيارة:</strong> <a href="{{ $data['car_url'] }}">رؤية السيارة</a></p>
</body>
</html>
