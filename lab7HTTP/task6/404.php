<?php
http_response_code(404);
include 'traffic_logger.php';
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сторінка не знайдена</title>
</head>

<body>

    <div>
        <h1>404 - Сторінка не знайдена</h1>
        <p>Вибачте, але запитана сторінка не існує.</p>
        <a href="index.php">На головну</a>
    </div>

</body>

</html>