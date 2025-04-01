<?php

$db = new PDO('mysql:host=localhost;dbname=lab7;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$totalStmt = $db->prepare("SELECT COUNT(*) FROM logs WHERE request_time >= NOW() - INTERVAL 1 DAY");
$totalStmt->execute();
$totalRequests = $totalStmt->fetchColumn();

$errorStmt = $db->prepare("SELECT COUNT(*) FROM logs WHERE status = 404 AND request_time >= NOW() - INTERVAL 1 DAY");
$errorStmt->execute();
$errorRequests = $errorStmt->fetchColumn();

$percent404 = ($totalRequests > 0) ? ($errorRequests / $totalRequests) * 100 : 0;

echo "<h2>Статистика 404 помилок за останню добу</h2>";
echo "<p>Загальна кількість запитів: $totalRequests</p>";
echo "<p>Кількість 404 помилок: $errorRequests</p>";
echo "<p>Відсоток 404 помилок: " . number_format($percent404, 2) . "%</p>";
echo "<a href='index.php'>На головну</a>";
if ($percent404 > 10) {
    echo "<h3>Попередження: Відсоток 404 помилок перевищив 10%! Перевірте сервер.</р>";
}