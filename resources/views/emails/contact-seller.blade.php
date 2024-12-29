<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسالة جديدة عن سيارتك</title>
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
        h2 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
            text-align: center;
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
        a {
            color: #0066cc;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
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
        <h2>رسالة جديدة عن سيارتك {{ $data['car_title'] }}</h2>
        <p><strong>الاسم:</strong> {{ $data['name'] }}</p>
        <p><strong>البريد الإلكتروني:</strong> {{ $data['email'] }}</p>
        <p><strong>رقم الهاتف:</strong> {{ $data['phone'] }}</p>
        <p><strong>الرسالة:</strong> {{ $data['message'] }}</p>
        <p><strong>عنوان السيارة:</strong> {{ $data['car_title'] }}</p>
        <p><strong>رابط السيارة:</strong> <a href="{{ $data['car_url'] }}" target="_blank">رؤية السيارة</a></p>
    </div>
</body>
</html>
