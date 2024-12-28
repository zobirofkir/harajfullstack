<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسالة جديدة من نموذج الاتصال</title>
</head>
<body>
    <h1>لديك رسالة جديدة</h1>
    <p><strong>الاسم:</strong> {{ $contact->name }}</p>
    <p><strong>البريد الإلكتروني:</strong> {{ $contact->email }}</p>
    <p><strong>الهاتف:</strong> {{ $contact->phone }}</p>
    <p><strong>الرسالة:</strong></p>
    <p>{{ $contact->message }}</p>
</body>
</html>
