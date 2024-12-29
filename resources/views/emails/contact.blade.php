<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسالة جديدة من نموذج الاتصال</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            direction: rtl;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            color: #333333;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            color: #333333;
            line-height: 1.6;
            margin: 10px 0;
        }
        p strong {
            color: #0066cc;
        }
        .footer {
            font-size: 14px;
            color: #888888;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>لديك رسالة جديدة</h1>
        <p><strong>الاسم:</strong> {{ $contact->name }}</p>
        <p><strong>البريد الإلكتروني:</strong> {{ $contact->email }}</p>
        <p><strong>الهاتف:</strong> {{ $contact->phone }}</p>
        <p><strong>الرسالة:</strong></p>
        <p>{{ $contact->message }}</p>
    </div>
</body>
</html>
