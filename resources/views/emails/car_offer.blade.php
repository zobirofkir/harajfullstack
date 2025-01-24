<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>عرض سيارتك</title>
</head>
<body>
    <h1>معلومات عرض السيارة</h1>
    <p><strong>عنوان السيارة:</strong> {{ $car->title }}</p>
    <p><strong>وصف السيارة:</strong> {{ $car->info }}</p>
    <p><strong>سعر العرض القابل للتفاوض:</strong>ريال {{ $offer->negotiable_offer_price }}</p>
</body>
</html>
