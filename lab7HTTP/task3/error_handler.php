<?php
ob_start();

register_shutdown_function('shutdownHandler');
function shutdownHandler()
{
    $error = error_get_last(); 
    if ($error !== null && $error['type'] === E_ERROR) {
        ob_clean(); 
        http_response_code(500);
        
        date_default_timezone_set('Europe/Kiev');
        $fix_time = date("H:i", strtotime("+30 minutes"));

        echo "<h1>500 Internal Server Error</h1>";
        echo "<p>Вибачте, сталася помилка сервера. Очікуваний час відновлення: {$fix_time}</p>";
    }
}

// $a = 1/0;

echo "<h1>Сторінка працює</h1><p>Все нормально!</p>";

