<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once 'Response.php';
    $response = new Response();
    $response->setStatus(200);
    $response->addHeader("Content-Type: text/html");
    $response->send("<h1>Вітаємо!</h1><p>Це динамічна відповідь.</p>");


    $response1 = new Response();
    $response1->setStatus(404);
    $response1->addHeader("Content-Type: text/html");
    $response1->send("<h1>404</h1><p>Сторінку не знайдено.</p>");
    ?>
</body>
</html>