<?php
$log_file = 'requests.log';
$limit = 5; 
$time_window = 10; 

$ip = $_SERVER['REMOTE_ADDR'];
$current_time = time();

$logs = file_exists($log_file) ? file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

$filtered_logs = [];
$request_count = 0;

foreach ($logs as $log) {
    list($log_ip, $log_time) = explode('|', $log);
    if ($current_time - $log_time < $time_window) {
        $filtered_logs[] = $log;
        if ($log_ip === $ip) {
            $request_count++;
        }
    }
}

if ($request_count >= $limit) {
    http_response_code(429);
    header('Retry-After: ' . $time_window);
    die('<h1>429 Too Many Requests</h1><p>Будь ласка, спробуйте пізніше.</p>');
}

$filtered_logs[] = "$ip|$current_time";
file_put_contents($log_file, implode("\n", $filtered_logs) . "\n");

http_response_code(200);
echo "<h1>Сторінка доступна</h1><p>Ваш запит успішно оброблено.</p>";
